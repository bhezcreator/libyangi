@extends('layouts.errors')

@section('title', 'Erreur serveur')
@section('code', '500')
@section('message', 'Erreur interne du serveur')
@section('description', 'Oups ! Il y a eu un problème sur le serveur. Veuillez réessayer plus tard.')