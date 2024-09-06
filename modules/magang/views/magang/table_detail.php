<?php if(isset($model_detail)): ?>
    <?php $no = 1; ?>
    <?php foreach ($model_detail as $key => $data): ?>
        <tr data-no='<?= $key ?>'  data-nisn='<?= $data['nisn'] ?>'>
            <td><?= $no++; ?><input type="hidden" id="number_<?= $key ?>" class="form-control" name="number[<?= $key ?>]" value='<?= $key ?>' readOnly></td>
            <td><?= isset($data['nisn']) ? $data['nisn'] : ''; ?><input type="hidden" id="MagangDetail-nisn_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][nisn]" value='<?= $data['nisn'] ?>'  readOnly></td>
            <td><?= isset($data['nama']) ? $data['nama'] : ''; ?><input type="hidden" id="MagangDetail-nama_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][nama]" value='<?= $data['nama'] ?>' readOnly></td>
            <td><?= isset($data['rombel']) ? $data['rombel'] : ''; ?><input type="hidden" id="MagangDetail-rombel_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][rombel]"  value='<?= $data['rombel'] ?>' readOnly></td>
            <td>
                <button class='btn btn-warning btn-flat btn-sm btn-edit' type='button' title='Edit'><i class='fontello icon-pencil'></i></button>
                &nbsp;
                <button class='btn btn-danger btn-flat btn-sm' id='btn-delete' type='button' title='Delete'><i class='fontello icon-trash'></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>