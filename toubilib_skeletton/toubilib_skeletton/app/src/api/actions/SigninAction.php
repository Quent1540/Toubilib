<?php
namespace toubilib\api\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use lachaudiere\webui\providers\AuthnProviderInterface;
use lachaudiere\webui\providers\CsrfTokenProvider;
use lachaudiere\webui\providers\CsrfTokenException;
use Slim\Routing\RouteContext;

class SigninAction {
    protected AuthnProviderInterface $authProvider;
    protected Twig $view;

    public function __construct(AuthnProviderInterface $authProvider, Twig $view) {
        $this->authProvider = $authProvider;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $routeContext = RouteContext::fromRequest($request);
        $router = $routeContext->getRouteParser();

        if ($request->getMethod() === 'POST') {
            $data = $request->getParsedBody();
            $email = trim($data['email'] ?? '');
            $password = $data['password'] ?? '';
            $submittedToken = $data['csrf_token'] ?? null;

            try {
                CsrfTokenProvider::check($submittedToken);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
                    throw new \InvalidArgumentException("Email valide et mot de passe sont requis.");
                }

                if ($this->authProvider->signin($email, $password)) {
                    return $response->withHeader('Location', $router->urlFor('home'))->withStatus(302);
                } else {
                    throw new \Exception("Identifiants incorrects.");
                }
            } catch (CsrfTokenException $e) {
                $error = "Erreur de sécurité. Veuillez réessayer.";
            } catch (\InvalidArgumentException $e) {
                $error = $e->getMessage();
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }

            return $this->view->render($response, 'signin.twig', [
                'error' => $error ?? null,
                'submitted_email' => $email,
            ]);

        } else {
            if ($this->authProvider->isSignedIn()) {
                return $response->withHeader('Location', $router->urlFor('home'))->withStatus(302);
            }

            if (isset($_SESSION['auth_message'])) {
                $m_error = $_SESSION['auth_message'];
                unset($_SESSION['auth_message']);
                return $this->view->render($response, 'signin.twig', [
                    'error' => $m_error,
                ]);
            }

            return $this->view->render($response, 'signin.twig', [
                'error' => null,
            ]);
        }
    }
}