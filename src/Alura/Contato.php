<?php

namespace App\Alura;

class Contato
{
    private string $email;
    private string $rua;
    private string $cep;
    private string $telefone;

    public function __construct(string $email, string $rua, string $cep, string $telefone)
    {
        $this->validaEmail($email);
        $this->endereco = $rua;
        $this->cep = $cep;
        $this->validaTelefone($telefone);
    }

    public function getUsuario(): string
    {
        $posicaoArroba = strpos($this->email, '@');

        if ($posicaoArroba === false) {
            return 'Usuario inválido';
        }

        return substr($this->email, 0, $posicaoArroba);
    }

    private function validaEmail(string $email): void
    {
        $validacaoEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($validacaoEmail === false) {
            $this->setEmail('Email inválido.');
            return;
        }

        $this->email = $validacaoEmail;
    }

    private function validaTelefone(string $telefone): void
    {
        $validacaoTelefone = preg_match('/^[0-9]{4}-[0-9]{4}$/', $telefone, $encontrados);

        if (!$validacaoTelefone) {
            $this->setTelefone('Telefone inválido');
            return;
        }

        $this->setTelefone($telefone);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setTelefone($telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getRua(): string
    {
        return $this->endereco;
    }

    public function getEnderecoCompleto(): string
    {
        $rua = $this->getRua();
        $cep = $this->getCep();

        if ($rua === '' && $cep === '') {
            return 'Endereco inválido.';
        }

        if ($rua === '') {
            $rua = 'Rua inválida';
        }

        if ($cep === '') {
            $cep = 'CEP inválido.';
        }

        $enderecoCep = [$rua, $cep];

        return implode(' - ', $enderecoCep);
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }
}
