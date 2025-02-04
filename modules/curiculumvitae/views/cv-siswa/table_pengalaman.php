<?php if(isset($model_detail)): ?>
    <?php $no = 1; ?>
    <?php foreach ($model_detail as $key => $data): ?>
        <tr data-no_pengalaman='<?= $key ?>'  data-perusahaan='<?= $data['perusahaan'] ?>' data-jabatan='<?= $data['jabatan'] ?>' data-tahun1='<?= $data['tahun1'] ?>' data-tahun2='<?= $data['tahun2'] ?>'>
            <td><?= $no++; ?></td>
            <td><?= isset($data['perusahaan']) ? $data['perusahaan'] : ''; ?></td>
            <td><?= isset($data['jabatan']) ? $data['jabatan'] : ''; ?></td>
            <td><?= isset($data['tahun1']) ? $data['tahun1'] : ''; ?></td>
            <td><?= isset($data['tahun2']) ? $data['tahun2'] : ''; ?></td>
            <td>
                <button class='btn btn-warning btn-flat btn-sm btn-edit_pengalaman' type='button' title='Edit'><i class='fontello icon-pencil'></i></button>
                &nbsp;
                <button class='btn btn-danger btn-flat btn-sm' id='btn-delete_pengalaman' type='button' title='Delete'><i class='fontello icon-trash'></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>