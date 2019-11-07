@extends("layouts.app")

@section("content")
    <p>Nom : {{$data->nom}}</p>
    <p>Éditeur : {{$data->editeur}}</p>
    <p>Prix : {{$data->prix}}</p>
    <p>Description : {{$data->description}}</p>
@endSection