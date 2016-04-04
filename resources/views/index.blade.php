@extends('layouts.master')

@section('title')
Quotes
@endsection

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" type="text/css" />
@endsection

@section('content')
    @if(!empty(Request::segment(1)))
    <section class="filter-bar">
        A filter has been set <a href="{{ route('index') }}">Show all quotes</a>
    </section>
    @endif
    @if(count($errors)>0)
        <section class="info-box fail">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li> 
                @endforeach
            </ul>
        </section>
    @endif
    @if(Session::has('success'))
        <section class="info-box success">
            {{Session::get('success')}}
        </section>
    @endif
    <section class="quotes">
        <h1>Latest quotes</h1>
        @for($i = 0; $i < count($quotes); $i++ )
            <article class="quote{{ $i % 3 ===0 ? ' first-in-line ' : (($i +1) % 3 === 0 ? ' last-in-line ' : '') }}">
                <div class="delete"><a href="{{route('delete',['quote_id' => $quotes[$i]->id ]) }}">x</a></div>
                {{ $quotes[$i]->quote }}
                <div class="info">Created by <a href="{{ route('index',['author' => $quotes[$i]->author->name ]) }}" class="">{{ $quotes[$i]->author->name }} </a>on {{ $quotes[$i]->created_at }}</div>
            </article>
        @endfor
 
        <div class="pagination">
            {{ $quotes->links() }}
        </div>
    </section>
    <section class="edit-quote">
        <h1>Add a quote</h1>
        <form method="POST" action="{{route('create') }}">
            <div class="input-group">
                <label for="author">Your name</label>
                <input type="text" name="author" id="author" placeholder="Your name"/>
            </div>
            <div class="input-group">
                <label for="quote">Your quote</label>
               <textarea name="quote" id="quote" cols="30" rows="5" placeholder="Quote"></textarea>
            </div> 
            <button type="submit" class="btn">Submit quote</button>
            <input type="hidden" name="_token" value="{{Session::token() }}"/>
        </form>
    </section>
@endsection