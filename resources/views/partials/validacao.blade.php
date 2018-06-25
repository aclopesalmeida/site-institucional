

    @if($errors->any())
    <p class="msg-erro">{{ implode('', $errors->all(':message')) }}</p>
    @endif
