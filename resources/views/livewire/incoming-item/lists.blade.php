<div class="card">
    <div class="card-header">
        <h3>Daftar Barang Masuk</h3>
    </div>
    <div class="card-body">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" id="" placeholder="Search..." wire:model.live="keyword">
        </div>
        {{ $IncomingItems->links() }}
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th>Asal Barang</th>
                        <th>Tanggal Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($IncomingItems as $key => $item)
                        <tr>
                            <td>{{ $IncomingItems->firstItem() + $key }}</td>
                            <td>{{ $item->item->item_code }}</td>
                            <td>{{ $item->item->item_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->origin }}</td>
                            <td>{{ $item->incoming_date }}</td>
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
        {{ $IncomingItems->links() }}
    </div>
    <!-- Modal -->
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

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editItem == true ? 'Edit' : 'Detail' }} Barang
                        Masuk</h1>
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
                            <input type="text" class="form-control" wire:model="item_name" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" wire:model="quantity"
                                {{ $editItem == false ? 'readonly' : '' }}>
                            @if ($errors->has('quantity'))
                                <div id="defaultFormControlHelp" class="form-text text-danger">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Asal Barang</label>
                            <input type="text" class="form-control" wire:model="origin"
                                {{ $editItem == false ? 'readonly' : '' }}>
                            @if ($errors->has('origin'))
                                <div id="defaultFormControlHelp" class="form-text text-danger">
                                    {{ $errors->first('origin') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" wire:model="incoming_date"
                                {{ $editItem == false ? 'readonly' : '' }}>
                            @if ($errors->has('incoming_date'))
                                <div id="defaultFormControlHelp" class="form-text text-danger">
                                    {{ $errors->first('incoming_date') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" wire:model="description" {{ $editItem == false ? 'readonly' : '' }}></textarea>
                    </div>
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
