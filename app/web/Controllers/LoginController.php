<?php

    namespace App\Web\Controllers;

    use App\Models\Users;
    use StormBin\Package\Request\Request;
    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    use StormBin\Package\Auth\Auth;

    class LoginController extends Controller
    {
        #Methode servant la page login
        public function index()
        {
            return Views::render("login");
        }

        public function login(Request $request){
            
            $email = $request->get('email');
            $password = $request->get('mot_de_passe');

            if (empty($email) || empty($password)) {
                echo '❌ Veuillez remplir tous les champs';
                return;
            }

            $userdata = Users::where('email', '=', $email)->first();

            if (!$userdata) {
                echo '❌ Aucun utilisateur trouvé avec cet email';
                return;
            }

            if (!password_verify($password, $userdata->password)) {
                echo '❌ Identifiants ou mot de passe invalide';
                return;
            }

            Auth::login([
                'id' => $userdata->id,
                'name' => $userdata->name,
                'surname' => $userdata->surname,
                'telephone' => $userdata->telephone,
                'email_verified_at' => $userdata->email_verified_at,
                'email' => $userdata->email,
                'password' => $userdata->password,
                'roles' => $userdata->roles ?? [],
            ]);

            return Views::redirect('/dashboard');
        }

        
    }
