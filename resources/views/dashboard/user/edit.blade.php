@extends("layouts.index")
@section("title", "User")
@section("content")
    <div class="d-flex align-items-center justify-content-between">
        <div class="card w-100">
            <div class="card-header">
                <h1>Edit {{ $user_detail->nama }}</h1>
            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" autofocus name="username" value="{{ $user->username }}" />
                    @foreach ($user_detail_key as $key)
                        <label for="{{ $key }}" class="text-capitalize">{{ $key }}</label>
                        @if ($key === "jenis_kelamin")
                            <select name="{{ $key }}" id="{{ $key }}" class="form-select">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L" @if ($user_detail[$key] === "L") selected @endif>L</option>
                                <option value="P" @if ($user_detail[$key] === "P") selected @endif>P</option>
                            </select>
                        @else
                            <input type="text" name="{{ $key }}" id="{{ $key }}" class="form-control"
                                value="{{ $user_detail[$key] }}">
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-success w-100 rounded-4 mt-4">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script type="module">
        function alertResponse(data) {
            let message = '';
            Object.values(data).flat().map((e) =>
                message += `<strong class="text-danger d-block">${e}</strong>`
            );

            swal.fire({
                titleText: "Gagal",
                icon: "error",
                html: message,
            })
        }

        function alertSuccess(type, toShow = '') {
            swal.fire({
                titleText: `Data berhasil di${type}`,
                icon: "success",
                text: `${toShow} Berhasil di${type}`,
            }).finally(() => window.location = "/dashboard/user/<?= $user->id ?>?role=<?= $user->role ?>")
        }
        $("form").on("submit", function(e) {
            e.preventDefault()
            const formData = new FormData(e.target)
            const toSend = Object.fromEntries(formData)
            axios.put("/api/user/<?= $user->role ?>/<?= $user->id ?>",toSend)
                .then(() => alertSuccess('edit', "<?= $user_detail->nama ?>"))
                .catch(({
                    response
                }) => alertResponse(response?.data))
        })
    </script>
@endsection
