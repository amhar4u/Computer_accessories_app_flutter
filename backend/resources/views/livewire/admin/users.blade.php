<div>
    <div class="container-fluid p-4">
        <div class="card rounded-3">
            <div class="card-header p-3">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="card-title mb-0">Users</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                            Create User
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Contact</th>
                                <th>Creation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $user->id }})">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $user->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger fw-bold">No Users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
