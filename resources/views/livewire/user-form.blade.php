<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" wire:model.lazy="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control" id="email" name="email" wire:model.lazy="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" name="age" wire:model.lazy="age">
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" wire:model.lazy="address">
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
