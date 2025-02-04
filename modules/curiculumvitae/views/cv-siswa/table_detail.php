<?php if(isset($model_detail)): ?>
    <?php $no = 1; ?>
    <?php foreach ($model_detail as $key => $data): ?>
        <tr data-no='<?= $key ?>'  data-sekolah='<?= $data['sekolah'] ?>' data-jurusan='<?= $data['jurusan'] ?>' data-periode1='<?= $data['periode1'] ?>' data-periode2='<?= $data['periode2'] ?>'>
            <td><?= $no++; ?></td>
            <td><?= isset($data['sekolah']) ? $data['sekolah'] : ''; ?></td>
            <td><?= isset($data['jurusan']) ? $data['jurusan'] : ''; ?></td>
            <td><?= isset($data['periode']) ? $data['periode'] : ''; ?></td>
            <td>
                <button class='btn btn-warning btn-flat btn-sm btn-edit' type='button' title='Edit'><i class='fontello icon-pencil'></i></button>
                &nbsp;
                <button class='btn btn-danger btn-flat btn-sm' id='btn-delete' type='button' title='Delete'><i class='fontello icon-trash'></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>