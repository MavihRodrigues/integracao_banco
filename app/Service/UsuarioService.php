<?php

namespace App\Service;

use App\Models\Usuario;

class UsuarioService
{
    public function create(array $dados){
        $user = Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'password' => $dados['password']
        ]);

        return $user;
    }

    public function update(array $dados){
        $usuario = Usuario::find($dados['id']);
        if($usuario == null){
            return [
                'status' => false,
                'message' => 'Usuário não encontrado'
            ];
        }

        if(isset($dados['password'])){
            $usuario->password =$dados['password'];
        }

        if(isset($dados['nome'])){
            $usuario->nome = $dados['nome'];
        }

        if(isset($dados['email'])){
        $usuario->email = $dados['email'];
        }

        if(isset($dados['password'])){
        $usuario->password = $dados['password'];
        }

        $usuario->save();

        return [
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ];
    }

    public function delete($id){
            $usuario = Usuario::find($id);
            if ($usuario == null){
                return [
                    'status' => false,
                    'message' => 'Usuário não encontrado'
                ];
            }
            $usuario->delete();
            return [
                'status' => true,
                'message' => 'Usuário excluído com sucesso'
            ];
        }

    public function findById($id){
        $usuario = Usuario::find($id);

        if($usuario == null){
            return [
                'message' => 'Usuário não encontrado'
            ];
        }

        return [
            'status' => true,
            'message' => 'Usuário encontrado',
            'data' => $usuario
        ];
    }

    public function getALL(){
        $usuarios = Usuario::all();

        return [
            'status' => true,
            'message' => 'Pesquisa efetuada com sucesso',
            'data' => $usuarios
        ];
    }

    public function searchByName($nome){
        $usuarios = Usuario::where('nome', 'like', '%'. $nome . '%')->get();
        if($usuarios->isEmpty()){
            return [
                'status' => false,
                'message' => 'Sem resultados'
            ];
        }

        return [
            'status' => true,
            'message' => 'Resultados Encontrados',
            'data' => $usuarios
        ];
    }

    public function searchByEmail($email){
        $usuarios = Usuario::where('email', 'like', '%'. $email . '%')->get();
        if($usuarios->isEmpty()){
            return[
                'status' => false,
                'message' => 'Sem resultados'
            ];
        }
        return [
            'status' => true,
            'message' => 'Resultados Encontrados',
            'data' => $usuarios
        ];
    }

}