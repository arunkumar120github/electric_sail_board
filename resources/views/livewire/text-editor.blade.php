<div wire:ignore>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

    <input id="{{ $editorId }}" type="hidden" name="content" value="{{ $value }}">
    <trix-editor wire:ignore input="{{ $editorId }}"></trix-editor>

    <script>
        var trixEditor = document.getElementById(@js($editorId));

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
</div>
