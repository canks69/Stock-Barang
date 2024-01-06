class RupiahFormatter {
    constructor(element) {
        this.element = element;
        this.attachEvents();

        // Memeriksa nilai awal saat memuat
        const initialValue = this.element.value.trim();
        if (initialValue !== '') {
            const formatted = this._format(initialValue);
            this.element.value = formatted;
        }
    }

    attachEvents() {
        this.element.addEventListener('input', this._onInput.bind(this));
    }

    _onInput(e) {
        const value = this.element.value;
        const formatted = this._format(value);
        this.element.value = formatted;
    }

    _format(value) {
        const number = this._getNumber(value);
        const formatted = this._formatNumber(number);
        return formatted;
    }

    _getNumber(value) {
        const number = value.replace(/\./g, '');
        return number;
    }

    _formatNumber(number) {
        const formatted = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        // Ketika Menginput nilai lebih dari 2 digit setelah decimal maka tidak akan terjadi perubahan
        const decimal = number.toString().split(',')[1];
        if (decimal) {
            const decimalLength = decimal.length;
            console.log(decimalLength);
            if (decimalLength >= 2) {
                return formatted.slice(0, -1);
            } else if( decimalLength == 1 ){
                return formatted + '0';
            }else {
                return formatted;
                
            }
        }

        return formatted;
    }
}

// Penggunaan
$(document).ready(function() {
    $('.input-float').each(function() {
        new RupiahFormatter(this);
    });
});
