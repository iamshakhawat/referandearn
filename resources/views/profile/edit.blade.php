@extends('layouts.dashboardlayout')
@section('content')
<div class="card profile-card">
    <div class="card-body">
        <h5 class="card-title">User Profile</h5>
        <hr>
        <p class="card-text mb-1">Name: {{ Auth::user()->name }}</p>
        <p class="card-text mb-1">Email: {{ Auth::user()->email }}</p>
        <p class="card-text mb-1">Referral Code: <span id="refCode" onclick="copyToClipboard('refCode')" style="text-decoration: underline;cursor:pointer;" title="Click to Copy">{{ Auth::user()->refercode }}</span></p>
        <p class="card-text mb-1">Referral Link: <a href="#" id="refLink" onclick="copyToClipboard('refLink')" style="text-decoration: underline;cursor:pointer;" title="Click to Copy">{{ url("register?code=".Auth::user()->refercode) }}</a></p>
    </div>
</div>
@endsection

@push('custom_js')
<script>
    function copyToClipboard(elementId) {
        const element = document.getElementById(elementId);
        const text = element.innerText || element.textContent;

        // Create a temporary textarea to copy the text
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);

        // Select the text and copy it to the clipboard
        textarea.select();
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(textarea);
    }
</script>

@endpush