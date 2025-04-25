<div class="card">
    <div class="card-header">
        <h3>Daftar Barang Masuk</h3>
    </div>
    <div class="card-body">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" id="" placeholder="Search..." wire:model.live="keyword">
        </div>
        {{ $items->links() }}
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $items->firstItem() + $key }}</td>
                            <td>{{ $item->item_code }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal" wire:click="detail({{ $item->id }})">
                                    <i class='bx bx-show'></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal" wire:click="edit({{ $item->id }})">
                                    <i class='bx bx-pencil'></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="delete_confirmation({{ $item->id }})">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="clear()"></button>
                </div>
                <div class="modal-body">
                    Anda yaking mau menghapus barang masuk '{{ $deletingName }}'
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="clear()">Tutup</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        wire:click="delete()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editItem == false ? 'Detail' : 'Edit' }}
                        Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="clear()"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="item_code" readonly wire:model="item_code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" {{ $editItem == false ? 'readonly' : '' }}
                                wire:model="item_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" {{ $editItem == false ? 'readonly' : '' }}
                                wire:model="quantity">
                        </div>
                    </div>
                    @if ($editItem == false)
                        <hr />
                        <h5 class="mb-3">Riwayat</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>Quantity</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemHistories as $history)
                                        <tr>
                                            <td><span
                                                    class="badge bg-{{ $history['status'] == 'MASUK' ? 'success' : 'danger' }}">{{ $history['status'] }}</span>
                                            </td>
                                            <td>{{ $history['asal'] }}</td>
                                            <td>{{ $history['tujuan'] }}</td>
                                            <td>{{ $history['quantity'] }}</td>
                                            <td>{{ $history['tanggal'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="clear()">Tutup</button>
                    @if ($editItem == true)
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                            wire:click="update()">Edit</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
