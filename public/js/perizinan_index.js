// dataTable
$(function () {
    $('#dataPermissions').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true
    })
})

// modal add
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById('btn-add').addEventListener('click', function () {
        document.getElementById('perizinan_add').value = '';
        document.getElementById('guard_name_add').value = 'web';
        $('#modal-add').modal('show');
    });

    document.getElementById('btn-save').addEventListener('click', function () {
        const perizinan = document.getElementById('perizinan_add').value.trim();
        const guard_name = document.getElementById('guard_name_add').value.trim();

        if (!perizinan) {
            alert('Nama perizinan tidak boleh kosong.');
            return;
        }

        fetch(`/permissions`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                perizinan,
                guard_name
            })
        })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else if (response.ok) {
                    alert('Data berhasil disimpan.');
                    $('#modal-add').modal('hide');
                    location.reload();
                } else {
                    return response.json().then(data => {
                        alert(data.message || 'Terjadi kesalahan.');
                    });
                }
            })
            .catch(error => {
                console.error(error);
                alert('Gagal menyimpan data.');
            });
    });
});

// modal edit
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentId = null;

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            currentId = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            document.getElementById('perizinan').value = name;
            document.getElementById('guard_name').value = 'web'; // default
            $('#modal-edit').modal('show');
        });
    });

    document.getElementById('btn-update').addEventListener('click', function () {
        if (!currentId) return;

        const perizinan = document.getElementById('perizinan').value.trim();
        const guard_name = document.getElementById('guard_name').value.trim();

        if (!perizinan) {
            alert('Nama perizinan tidak boleh kosong.');
            return;
        }

        fetch(`/permissions/${currentId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                perizinan,
                guard_name
            })
        })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else if (response.ok) {
                    alert('Data berhasil diperbarui.');
                    $('#modal-edit').modal('hide');
                    location.reload();
                } else {
                    return response.json().then(data => {
                        alert(data.message || 'Terjadi kesalahan.');
                    });
                }
            })
            .catch(error => {
                console.error(error);
                alert('Gagal mengupdate data.');
            });
    });
});

// modal delete
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (confirm(`Apakah anda yakin ingin menghapus perizinan "${name}"?`)) {
                fetch(`/permissions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else {
                            return response.json();
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                        alert('Gagal menghapus data.');
                    });
            }
        });
    });
});