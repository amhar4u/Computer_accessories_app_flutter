<div>
    <div class="container-fluid">
        <div class="row">
            <h1>Welcome to the Admin Dashboard</h1>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-md-12">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <button class="btn btn-primary" wire:click="logout">Logout</button>
            </div>
        </div>
    </div>
</div>
