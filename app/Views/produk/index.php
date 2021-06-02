<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-box"></i> Produk</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Produk Table
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> Add data</a>
                    <a href=<?= base_url('export-pdf'); ?> class="btn btn-primary btn-sm mb-2 fa fa-file-pdf"> Export PDF</a>
                    <a href=<?= base_url('export-excel'); ?> class="btn btn-primary btn-sm mb-2 fa fa-file-excel"> Export Excel</a>


                    <?php
                    $errors = session()->getFlashdata('Failed');
                    if (!empty($errors)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-times"></i> Failed</strong> data not added to database.
                            <ul>
                                <?php foreach ($errors as $e) { ?>
                                    <li><?= esc($e); ?></li>
                                <?php } ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashData('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-check"></i> Success</strong> <?= session()->getFlashData('success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Kategori</th>
                                    <th>Quantity</th>
                                    <th>SKU</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($all_data as $datas) : ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= esc($datas->name); ?></td>
                                        <td><?= esc($datas->category); ?></td>
                                        <td><?= esc($datas->quantity); ?></td>
                                        <td><?= esc($datas->sku); ?></td>
                                        <td class="text-center" width="20%">
                                            <a href="" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#updateModal<?= $datas->id; ?>">
                                                Update
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#deleteModal<?= $datas->id; ?>">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('produk/add_data'); ?>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">- Select -</option>
                            <option value="Alat Tulis">Alat Tulis</option>
                            <option value="Buku Tulis">Buku Tulis</option>
                            <option value="Document Organizer">Document Organizer</option>
                            <option value="Kertas">Kertas</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                            <option value="Pengikat & Perekat">Pengikat & Perekat</option>
                            <option value="Surat-Menyurat">Surat-Menyurat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" id="sku" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Update modal -->
    <?php foreach ($all_data as $datas) : ?>
        <div class="modal fade" id="updateModal<?= $datas->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('produk/update_data/' . $datas->id); ?>
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $datas->id; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $datas->name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="categ">Category</label>
                            <select name="category" id="categ" class="form-control">
                                <?php if ($categ = $datas->category ?? $datas->category) : ?>
                                    <option value="">- Select -</option>
                                    <option value="Alat Tulis" <?= $categ == 'Alat Tulis' ? 'selected' : null ?>>
                                        Alat Tulis
                                    </option>
                                    <option value="Buku Tulis" <?= $categ == 'Buku Tulis' ? 'selected' : null ?>>
                                        Buku Tulis
                                    </option>
                                    <option value="Document Organizer" <?= $categ == 'Document Organizer' ? 'selected' : null ?>>
                                        Document Organizer
                                    </option>
                                    <option value="Kertas" <?= $categ == 'Kertas' ? 'selected' : null ?>>
                                        Kertas
                                    </option>
                                    <option value="Lain-Lain" <?= $categ == 'Lain-Lain' ? 'selected' : null ?>>
                                        Lain-Lain
                                    </option>
                                    <option value="Pengikat & Perekat" <?= $categ == 'Pengikat & Perekat' ? 'selected' : null ?>>
                                        Pengikat & Perekat
                                    </option>
                                    <option value="Surat-Menyurat" <?= $categ == 'Surat-Menyurat' ? 'selected' : null ?>>
                                        Surat-Menyurat
                                    </option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" id="quantity" class="form-control" value="<?= $datas->quantity; ?>">
                        </div>
                        <div class="form-group">
                            <label for="sku">Sku</label>
                            <input type="text" name="sku" id="sku" class="form-control" value="<?= $datas->sku; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Delete modal -->
    <?php foreach ($all_data as $datas) : ?>
        <div class="modal fade" id="deleteModal<?= $datas->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i> Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('produk/delete_data/' . $datas->id); ?>
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $datas->id; ?>">
                        <p>Click the Delete button to delete data (<?= $datas->name; ?>)..!!!</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $this->endSection(); ?>
