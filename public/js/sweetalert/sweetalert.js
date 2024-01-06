class SweetAlert {
    alertMessage(title, text, icon){
        Swal.fire({
            title: title, 
            text: text, 
            icon: icon,
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'bg-foreground text-body'
            },
        });
    }
    alertDelete(title, text, icon) {
        return Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true,
            customClass: {
                cancelButton: 'btn m-2 btn-outline-danger',
                confirmButton: 'btn m-2 btn-outline-primary',
                popup: 'bg-foreground text-body'
            },
            buttonsStyling: false
        });
    }
    Error(message) {
        return Swal.fire({
            title: 'Kesalahan',
            text: message,
            icon: 'error',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
    
            }
        })
    }
    Warning(message){
        return Swal.fire({
            title: 'Peringatan',
            text: message,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
    
            }
        })
    }
    Success(message) {
        return Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: message,
            showConfirmButton: false,
            timer: 1500
        })
    }

    confirmDelete(e, id) {
        e.preventDefault();
        return Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.querySelector(`form.formDelete${id}`);
                form.submit();
            }
        })
    }

    swallCancel(url){
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda Akan membatalkan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
}
  