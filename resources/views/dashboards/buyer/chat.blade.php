@extends('layouts.app')

@section('title', 'Chat')

@section('content')

<div class="container">
    <div id="app">
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body">
                <chat-messages :messages="messages"></chat-messages>
            </div>
            <div class="card-footer">
                <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
            </div>
        </div>
    </div>
</div>

@endsection