<div class="register-form mt-4">
    <h6 class="mb-3 text-center">Silahkan Masuk</h6>

    <form wire:submit="save">
        <div class="form-group">
            <input class="form-control" type="text" id="email" placeholder="email" wire:model="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group position-relative">
            <input class="form-control" id="psw-input" type="password" placeholder="Enter Password" wire:model="password">
            <div class="position-absolute" id="password-visibility">
                <i class="bi bi-eye"></i>
                <i class="bi bi-eye-slash"></i>
            </div>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-primary w-100" type="submit">Masuk</button>
    </form>
</div>
