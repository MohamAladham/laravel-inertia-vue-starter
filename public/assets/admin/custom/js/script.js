function generalOnSuccess(text = '', heading = '', callback = undefined, autoDismiss = true) {
    heading = heading ? heading : 'تمت حفظ البيانات بنجاح!';
    text = text ? text : 'سيتم تحويلك تلقائياً..';

    Swal.fire({
        title: heading,
        text: text,
        type: "success",
        confirmButtonText: "موافق",
        showCancelButton: 0,
        confirmButtonColor: "#7367f0",
    });

    if (autoDismiss) {
        setTimeout(function () {
            Swal.close();
            if (callback !== undefined) {
                callback();
            }
        }, 2000);
    }
}

function generalOnُError(text = '', heading = '') {
    heading = heading ? heading : 'خطأ';
    text = text ? text : 'لم يتم حفظ البيانات بنجاح';

    Swal.fire({
        title: heading,
        html: text,
        type: "error",
        confirmButtonText: "موافق",
        showCancelButton: 0,
        confirmButtonColor: "#7367f0",
        cancelButtonColor: "#f46a6a"
    });
}


function confirm(text = '', callback) {
    let title = 'هل أنت متأكد';
    text = text ? text : 'هل أنت متأكد';
    Swal.fire({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#f46a6a",
        cancelButtonColor: "#7367f0",
        cancelButtonText: "إلغاء الأمر",
        confirmButtonText: "تأكيد"
    }).then(function (t) {
        if (t.value) {
            return callback();
        }
    });
}
