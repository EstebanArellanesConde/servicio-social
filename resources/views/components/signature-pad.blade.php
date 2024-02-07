<div x-data="signaturePad(@entangle($attributes->wire('model')))">
    <div>
        <canvas x-ref="signature_canvas" class="bg-white border rounded shadow">

        </canvas>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', (value) => ({
                signaturePadInstance: null,
                value: value,
                init(){
                    this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                    this.signaturePadInstance.addEventListener("endStroke", ()=>{
                        this.value = this.signaturePadInstance.toDataURL('image/png');
                    });
                },
            }))
        })
    </script>
@endpush
