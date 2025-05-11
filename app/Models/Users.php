<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Users extends Model
    {
        use HasFactory;

        protected $table = 'users'; // Nom de la table

        protected $primaryKey = 'id'; // Clé primaire de la table

        protected $fillable = [
            'name',
            'surname',
            'telephone',
            'email',
            'password'
        ]; // Champs remplissables

        protected $guarded = [
            'id'

        ]; // Champs protégé 

        public $timestamps = true; // Active created_at et updated_at si nécessaire

        // gestion des clé etrangère 
        public function service(){
            
        }
    }
