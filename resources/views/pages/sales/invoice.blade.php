<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>invoice | {{ $sales->transno }}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(4) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #414dbb;
                color: #ddd;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total {
				border-top: 2px solid #eee;
                background: #414dbb;
                color: #ddd;
				font-weight: bold;

			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="4">
						<table>
							<tr>
								<td class="title" >
                                    INVOICE
									{{-- <img
										src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
										style="width: 100%; max-width: 300px"
									/> --}}
								</td>

								<td width="200px;">
									No #: {{ $sales->transno }}<br />
									Dibuat: {{ $sales->created }}<br />
									Print: {{ $sales->print }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="4">
						<table>
							<tr>
								<td>
									{{ $sales->customer->name }} ( {{ $sales->customer->code }} )<br />
									{{ $sales->customer->address }}<br />
								</td>

								<td>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td width="350px">Item</td>
                    <td width="100px">Jumlah</td>
					<td width="150px">Harga</td>
                    <td>Total</td>
				</tr>
                @foreach ($salesdetail as $item)
                    <tr class="item">
                        <td>{{ $item->stock->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach

				<tr class="total">
					<td colspan="3"><b>Total</b></td>
					<td>Rp.{{ $sales->total }}</td>
				</tr>
			</table>
		</div>
	</body>
</html>