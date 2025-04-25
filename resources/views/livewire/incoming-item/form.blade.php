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
                <label class="form-label">Status Barang</label>
                <select class="form-control" wire:model.live="item_status">
                    <option value="0">Belum Ada</option>
                    <option value="1">Sudah Ada</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Barang</label>
                @if ($item_status == 0)
                    <input type="text" class="form-control" wire:model="item_name">
                @else
                    <select name="" class="form-control" id="" wire:model.live="item_id">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                        @endforeach
                    </select>
                @endif
                @if ($errors->has('item_name'))
                    <div id="defaultFormControlHelp" class="form-text text-danger">
                        {{ $errors->first('item_name') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" wire:model="quantity">
                @if ($errors->has('quantity'))
                    <div id="defaultFormControlHelp" class="form-text text-danger">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Asal Barang</label>
                <input type="text" class="form-control" wire:model="origin">
                @if ($errors->has('origin'))
                    <div id="defaultFormControlHelp" class="form-text text-danger">
                        {{ $errors->first('origin') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" wire:model="incoming_date">
                @if ($errors->has('incoming_date'))
                    <div id="defaultFormControlHelp" class="form-text text-danger">
                        {{ $errors->first('incoming_date') }}
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
