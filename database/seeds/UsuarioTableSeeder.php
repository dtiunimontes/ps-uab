<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nome' => 'DTI - Unimontes',
            'email' => 'dti@unimontes.br',
            'password' => bcrypt('c8x2v'),
            'cpf' => '09493912639',
            'rg' => 'mg16.026.529',
            'org_exped' => 'ssp mg',
            'data_nasc' => '1996-04-25',
            'telefone' => '38991522567',
            'necessidade_especial' => 'Não',
            'permissao' => 2,
            'cep' => '39401009',
            'logradouro' => 'Rua Silas Canela',
            'numero' => '52',
            'cidade' => 'Janaúba',
            'bairro' => 'Cidade Nova',
            'estado' => 'MG',
        ]);

    }
}
