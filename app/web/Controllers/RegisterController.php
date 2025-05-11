<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    use StormBin\Package\Request\Request;
    use App\Models\Users;
    class RegisterController extends Controller
    {
        public function index()
        {
            return Views::render("register");
        }
        public function hasherMotDePasse($motDePasse) {
            return password_hash($motDePasse, PASSWORD_DEFAULT);
        }
        
        public function register(Request $request){
            $nom = $request->get('nom');
            $prenom = $request->get('prenom');
            $email = $request->get('email');
            $telephone = $request->get('telephone');
            $password = $this->hasherMotDePasse( $request->get('mot_de_passe'));
            $confirmation = $request->get('confirmation');
            echo ''.$nom.''.$prenom.''.$email. ''.$telephone.''.$password.''.$confirmation.'';
            
            Users::create([
                'name'=>$nom,
                'email'=>$email,
                'password'=>$password,
                'surname'=>$prenom,
                'telephone'=>$telephone,
            ]);
            echo('Utilisateur cree');
        }
    }
