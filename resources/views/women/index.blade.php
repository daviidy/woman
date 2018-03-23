@extends('layouts.app')
@section('title', "La liste complète" )
@section('main')
    <h1 class="ml-1">Les plus belles chaussures du monde</h1>
    <div class="row justify-content-center">
        @foreach ($women as $woman)
            <section class="col-md-4 pb-3">
                <div class="card">
                    <img class="card-img-top p-2" src="/img/women/{{ $woman->image }}" height="" width="auto" />
                    <ul class="card-block list-unstyled">
                        <li class="pull-left">
                            <a href="{{ route('women.show', $woman) }}">
                                {{ $woman->name }}
                            </a>
                        </li>
                        <li class="pull-right">
                            <a href="{{ route('women.edit', $woman) }}"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                        </li>
                        <li class="pull-right">
                            <form action="{{ route('women.destroy', $woman) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="fa fa-trash btn-link text-danger" type="submit"></button>
                          </form>
                        </li>
                    </ul>
                </div>
            </section>
        @endforeach
        {{ $women->links() }}
    </div>
@endsection
