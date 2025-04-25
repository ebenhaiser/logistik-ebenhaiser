<x-layout>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Quantity</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incomingItems as $incomingItem)
                                    <tr>
                                        <td>{{ $incomingItem->item->item_code }}</td>
                                        <td>{{ $incomingItem->item->item_name }}</td>
                                        <td>{{ $incomingItem->quantity }}</td>
                                        <td>{{ $incomingItem->incoming_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <a href="{{ route('incomingItems.list') }}" class="btn btn-outline-secondary btn-sm mt-3">More</a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Barang Keluar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Quantity</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outgoingItems as $outgoingItem)
                                    <tr>
                                        <td>{{ $outgoingItem->item->item_code }}</td>
                                        <td>{{ $outgoingItem->item->item_name }}</td>
                                        <td>{{ $outgoingItem->quantity }}</td>
                                        <td>{{ $outgoingItem->outgoing_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <a href="{{ route('outgoingItems.list') }}"
                            class="btn btn-outline-secondary btn-sm mt-3">More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Daftar Barang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->item_code }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <a href="{{ route('itemList.view') }}" class="btn btn-outline-secondary btn-sm mt-3">More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
