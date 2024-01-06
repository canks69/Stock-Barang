class RowTransaction {
    constructor() {
        this.tbody = document.querySelector('#tableTransaction tbody');
        this.buttonDelete = document.querySelectorAll('#tableTransaction #deleteRow');
        this._addListeners();
        this._selectStockCode();
        this._countTotal();
        this._initRupiahFormatter();
        this._countNetTotal();
        this._deleteRow();
    }

    _addListeners() {

        document.querySelector('#addRow').addEventListener('click', this._addRow.bind(this));
    }

    _deleteRow(){
        document.querySelectorAll('#tableTransaction #deleteRow').forEach((el) => {
            el.addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        el.parentElement.parentElement.remove();
                        this._selectStockCode();
                        this._countTotal();
                        this._countNetTotal();
                    }
                })
            });
        });
    }

    _initRupiahFormatter() {
        const elements = document.querySelectorAll('.input-float'); // Mengganti ini dengan selector yang sesuai
        elements.forEach(element => {
            new RupiahFormatter(element);
        });
    }


    _countTotal(){
        document.querySelectorAll('input').forEach((el) => {
            el.addEventListener('change', (e) => {
                var tr = e.target.parentElement.parentElement;
                var qty = tr.querySelector('input[name="qty[]"]').value;
                var price = tr.querySelector('input[name="price[]"]').value;
                var total = tr.querySelector('input[name="rate[]"]');
                // Remove . from price and convert to number
                price = price.replace(/\./g, '');
                price = parseInt(price);
                // Remove . from qty and convert to number
                qty = qty.replace(/\./g, '');
                qty = parseInt(qty);
                // Count total
                total.value = price * qty;
                this._initRupiahFormatter();
                this._countNetTotal();
            });
            
        });
    }

    _countNetTotal(){
        var netTotal = document.querySelector('#netTotal');
        var netTotalValue = 0;
        document.querySelectorAll('input[name="rate[]"]').forEach((el) => {
            var value = el.value;
            value = value.replace(/\./g, '');
            value = parseInt(value);
            netTotalValue += value;
        });

        netTotal.value = netTotalValue;

        this._initRupiahFormatter();
    }

    _selectStockCode(){
        document.querySelectorAll('.select-code').forEach((el) => {
            el.addEventListener('change', (e) => {
                var code = e.target.value;
                if(code != ''){
                    $.ajax({
                        url: '/api/stockid/'+code,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var tr = e.target.parentElement.parentElement;
                            tr.querySelector('input[name="qty[]"]').value = 1;
                            tr.querySelector('input[name="price[]"]').value = data.price;
                            tr.querySelector('input[name="rate[]"]').value = data.price;
                            rowTransaction._countTotal(); 
                            rowTransaction._countNetTotal();
                        }
                    });
                }
            });
        });
    }

    _addRow() {
        var tr = document.createElement('tr');
        tr.appendChild(this._addSelectCode());
        tr.appendChild(this._addInputQty());
        tr.appendChild(this._addInputPrice());
        tr.appendChild(this._addInputTotal());
        tr.appendChild(this._addButtonDelete());
        this.tbody.appendChild(tr);
        this._deleteRow();
        this._selectStockCode();
        this._countTotal();
        this._countNetTotal();
    }

    _addSelectCode(){
        var stocks = JSON.parse(localStorage.getItem('stocks'));
        var select = document.createElement('select');
        select.classList.add('form-control');
        select.classList.add('select-code');
        select.classList.add('input-float');
        select.setAttribute('name', 'code[]');
        select.setAttribute('required', 'required');

        var option = document.createElement('option');
        option.setAttribute('value', '');
        option.innerHTML = 'Pilih barang';
        option.setAttribute('disabled', 'disabled');
        option.setAttribute('selected', 'selected');
        select.appendChild(option);

        stocks.forEach(function(stock) {
            var option = document.createElement('option');
            option.setAttribute('value', stock.id);
            option.innerHTML = stock.code + ' - ' + stock.name;
            select.appendChild(option);
        });

        return this._setColumnElemets(select);
    }

    _addInputQty(){
        var input = document.createElement('input');
        input.classList.add('form-control');
        input.classList.add('input-float');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'qty[]');
        input.setAttribute('placeholder', '00')
        input.setAttribute('required', 'required');
        input.setAttribute('value', '0');

        return this._setColumnElemets(input);
    }

    _addInputPrice(){
        var input = document.createElement('input');
        input.classList.add('form-control');
        input.classList.add('input-float');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'price[]');
        input.setAttribute('placeholder', '00')
        input.setAttribute('required', 'required');
        input.setAttribute('value', '0');

        return this._setColumnElemets(input);
    }

    _addInputTotal(){
        var input = document.createElement('input');
        input.classList.add('form-control');
        input.classList.add('input-float');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'rate[]');
        input.setAttribute('placeholder', '00')
        input.setAttribute('value', '0');
        input.setAttribute('readonly', '');

        return this._setColumnElemets(input);
    }

    _addButtonDelete(){
        var button = document.createElement('button');
        var icon = document.createElement('i');
        button.setAttribute('class','btn btn-sm btn-icon btn-icon-only btn-danger mb-1');
        button.setAttribute('type', 'button');
        button.setAttribute('title', 'Delete');
        button.setAttribute('id', 'deleteRow')
        icon.setAttribute('class', 'fas fa-trash');
        button.appendChild(icon);

        return this._setColumnElemets(button);
    }
    
    
    _setColumnElemets(elemet){
        var td = document.createElement('td');
        td.appendChild(elemet);

        return td;
    }

}

var rowTransaction = new RowTransaction();