<x-layouts.main title="Verify email" >
    Please, verify your email.

    <x-form route="{{ route( 'verification.send') }}" method="POST" >
        <button class="btn btn-success mt-3" class="btn btn">Send me link again</button>
    </x-form>

</x-layouts.main>
