<div class="card">
    <div class="card-header">
        <h3>Pencatatan Barang Masuk</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" class="form-control" name="item_code" readonly wire:model="item_code">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Barang</label>
                <select name="" class="form-control" id="" wire:model.live="item_id">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" wire:model="quantity"
                    @if ($item_id != null) placeholder="Tersedia: {{ $item_quantity }}"> @endif
                    @if ($errors->has('quantity')) <div id="defaultFormControlHelp" class="form-text text-danger">
                        {{ $errors->first('quantity') }}
                    </div> @endif
                    </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tujuan Barang</label>
                    <input type="text" class="form-control" wire:model="destination">
                    @if ($errors->has('destination'))
                        <div id="defaultFormControlHelp" class="form-text text-danger">
                            {{ $errors->first('destination') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Keluar</label>
                    <input type="date" class="form-control" wire:model="outgoing_date">
                    @if ($errors->has('outgoing_date'))
                        <div id="defaultFormControlHelp" class="form-text text-danger">
                            {{ $errors->first('outgoing_date') }}
                        </div>
                    @endif
                </div>

            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" wire:model="description"></textarea>
            </div>
            <div align="right">
                <button class="btn btn-primary" wire:click="store()">
                    Simpan
                </button>
            </div>
        </div>
    </div>
