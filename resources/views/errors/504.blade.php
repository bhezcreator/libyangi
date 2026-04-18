@extends('layouts.errors')

@section('title', 'Délai d’attente dépassé')
@section('code', '504')
@section('message', 'Serveur en amont non réactif')
@section('description', 'Le serveur en amont a mis trop de temps à répondre. Réessayez dans quelques instants.')