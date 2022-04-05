<?php

namespace App\Alura;

class Usuario
{
    private string $nome;
    private string $sobrenome;
    private string $senha;
    private string $genero;
    private string $tratamento;

    public function __construct(string $nome, string $senha, string $genero)
    {
        $this->setNomeSobrenome($nome);
        $this->validaSenha($senha);
        $this->tratamentoSobrenome($nome, $genero);
    }

    private function setNomeSobrenome(string $nome): void
    {
        $nomeSobrenome = explode(' ', $nome, 2);

        if ($nomeSobrenome[0] === '') {
            $this->nome = 'Nome inválido';
        } else {
            $this->nome = $nomeSobrenome[0];
        }

        if (count($nomeSobrenome) < 2) {
            $this->sobrenome = 'Sobrenome inválido';
        } else {
            $this->sobrenome = $nomeSobrenome[1];
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    private function validaSenha(string $senha): void
    {
        $tamanhoSenha = strlen(trim($senha));

        if ($tamanhoSenha < 6) {
            $this->senha = 'Senha inválida';
            return;
        }

        $this->senha = $senha;
    }

    private function tratamentoSobrenome(string $nome, string $genero): void
    {
        if ($genero === 'M') {
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Sr.', $nome, 1);
        }

        if ($genero === 'F') {
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Sr.ª', $nome, 1);
        }
    }

    public function getTratamento(): string
    {
        return $this->tratamento;
    }
}
