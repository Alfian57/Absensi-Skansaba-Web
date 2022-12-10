$(document).ready(function () {
    // MENDAPATKAN URL QUERY
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const grade = urlParams.get("grade");
    //END

    let url = null;
    if (grade == null) {
        url = "/api/getAttendances";
    } else {
        url = "/api/getAttendances/" + grade;
    }

    setInterval(() => {
        let data = `<thead><link rel="stylesheet" href="/css/present.css">`;
        data =
            data +
            `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></thead>`;
        data =
            data +
            `<tr class="table-primary">
                    <th class='d-md-table-cell d-none'>#</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th class='d-md-table-cell d-none'>Foto</th>
                    <th>Keterangan</th>
                </tr>`;
        $.ajax({
            type: "GET",
            url: url,
            cache: "false",
            success: function (response) {
                if (response.length == 0) {
                    data = `<div class="text-center">
                                <hr>
                                <img src="/img/bg-present.svg" alt="Data Absensi Kosong" class="img-fluid w-75" style="margin-top: -25px">
                                <h3 class="text-danger mt-1">Data Absensi Masih Kosong</h3>
                            </div>`;
                }

                $.each(response, function (index, value) {
                    let color = null;
                    if (value.desc === "masuk") {
                        color = "text-primary";
                    } else if (
                        value.desc === "sakit" ||
                        value.desc === "ijin"
                    ) {
                        color = "text-warning";
                    } else if (value.desc === "masuk (bolos)") {
                        color = "text-danger";
                    }

                    if (value.photo == undefined) {
                        data =
                            data +
                            `<tr>
                        <td class='d-md-table-cell d-none'>` +
                            (index + 1) +
                            `</td>
                        <td>` +
                            value.name +
                            `</td>
                        <td>` +
                            value.grade +
                            `</td>
                        <td class='text-danger d-md-table-cell d-none'>Tidak Ada Foto</td>
                        <td class='` +
                            color +
                            `''>` +
                            value.desc +
                            `</td>
                    </tr>`;
                    } else {
                        data =
                            data +
                            `<tr>
                        <td class='d-md-table-cell d-none'>` +
                            (index + 1) +
                            `</td>
                        <td>` +
                            value.name +
                            `</td>
                        <td>` +
                            value.grade +
                            `</td>
                        <td class='d-md-table-cell d-none'>
                            <div class='profile-pic-box rounded-circle'>
                                <a href="` +
                            value.photo +
                            `" target="_blank">
                                    <img src="` +
                            value.photo +
                            `" alt="Profile" class="img-fluid">
                                </a>
                            </div>
                        </td>
                        <td class='` +
                            color +
                            `'>` +
                            value.desc +
                            `</td>
                    </tr>`;
                    }
                });
                $(".attendance-data").html(data);
            },
        });
    }, 1000);
});
