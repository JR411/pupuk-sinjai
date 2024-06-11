@extends('layouts.informasi')

@section('card')

@php
    $dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'pupuk';
$dbdsn = "mysql:dbname={$dbname};host={$dbhost}";
try {
	$db = new PDO($dbdsn, $dbuser, $dbpass);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
@endphp


    <div class="row">
        <div class="text-start">
            <h3 class="mt-5 text-white">Tambah Desa</h3>
        </div>
    </div>
    </header>
    </main>
    <div class="content-box position-relative">
        <div class="mx-auto card col-10 mt-5">
            <div class="card-body mx-auto col-11">
                {{-- <form action="/pemerintah/data-desa" method="post"> --}}
                <form action="/pemerintah/valid_lokasi" method="post">
                    @csrf
                    {{-- <div class="form-group mb-3">
                        <label for="nama_desa" class="label">Nama Desa</label>
                        <input type="text" name="nama_desa" class="form-control @error('nama_desa') is-invalid @enderror"
                            placeholder="Nama Desa" value="{{ old('nama_desa') }}" required>
                        @error('nama_desa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}


                    <div class="mb-3">
                        <label for="distributor_id">Distributor</label>
                        <select name="distributor_id" class="form-select" required>
                            <option value="" selected disabled hidden>Pilih Distributor</option>
                            @foreach ($distributor as $dist)
                                <option value="{{ $dist->id }}"
                                    {{ $dist->id == old('distributor_id') ? 'selected' : '' }}>
                                    {{ $dist->cv }}</option>
                            @endforeach
                        </select>
                        @error('distributor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    {{-- wilayah --}}
        <div class="form-group mb-3">
            <label class="label" for="alamat">Provinsi*</label>
        @php
            $wil = array(
                2 => array(5, 'Kota/Kabupaten', 'kab'),
                5 => array(8, 'Kecamatan', 'kec'),
                8 => array(13, 'Kelurahan', 'kel')
            );
            if (isset($_GET['id']) && !empty($_GET['id'])) :
                $n = strlen($_GET['id']);
                $query = $db->prepare("SELECT * FROM wilayah WHERE LEFT(kode,:n)=:id AND CHAR_LENGTH(kode)=:m ORDER BY nama");
                $query->execute(array(':n' => $n, ':id' => $_GET['id'], ':m' => $wil[$n][0]));
                echo "<option value=''>Pilih {$wil[$n][1]}</option>";
                while ($d = $query->fetchObject())
                    echo "<option value='{$d->kode}'>{$d->nama}</option>";
            else :
        @endphp




                <select name="prov" id="prov" class="form-control" onchange="ajax(this.value)">
                    <option value="">Provinsi</option>
                    <?php
                    $query = $db->prepare("SELECT kode,nama FROM wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama");
                    // $query = $db->prepare("SELECT kode,nama FROM wilayah WHERE CHAR_LENGTH(kode)=5 ORDER BY nama");
                    $query->execute();
                    while ($data = $query->fetchObject())
                        echo '<option value="' . $data->kode . '">' . $data->nama . '</option>';
                    ?>
                <select>


			<?php foreach ($wil as $w) : ?>
				<tr id='<?php echo $w[2]; ?>_box'>
					<td><?php echo $w[1]; ?></td>
					<td>
						<select name="adadeh" class="form-control" id="<?php echo $w[2]; ?>" onchange="ajax(this.value)">
							<option value="">Pilih <?php echo $w[1]; ?></option>
						</select>
					</td>
				</tr>
			<?php endforeach; ?>

        @php
            endif;
        @endphp
        </div>




                    <button type="submit" class="btn form-control btn-primary">Tambah Desa</button>
                </form>
            </div>
        </div>
    </div>






    {{-- wilayah --}}
<script>
    var my_ajax = do_ajax();
    var ids;
    var wil = new Array('kab', 'kec', 'kel');

    function ajax(id) {
        if (id.length < 13) {
            ids = id;
            var url = "?id=" + id + "&sid=" + Math.random();
            my_ajax.onreadystatechange = stateChanged;
            my_ajax.open("GET", url, true);
            my_ajax.send(null);
        }
    }

    function do_ajax() {
        if (window.XMLHttpRequest) return new XMLHttpRequest();
        if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
        return null;
    }

    function stateChanged() {
        var n = ids.length;
        var w = (n == 2 ? wil[0] : (n == 5 ? wil[1] : wil[2]));
        var data;
        if (my_ajax.readyState == 4) {
            data = my_ajax.responseText;
            document.getElementById(w).innerHTML = data.length >= 0 ? data : "<option selected>Pilih Kota/Kab</option>";
            <?php foreach ($wil as $k => $w) : ?>
                document.getElementById("<?php echo $w[2]; ?>_box").style.display = (n > <?php echo $k - 1; ?>) ? 'table-row' : 'none';
            <?php endforeach; ?>
        }
    }
</script>

@endsection
