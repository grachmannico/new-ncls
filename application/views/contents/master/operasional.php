<?php 
  // expense
  $my = date('Y-m-');
  $fr = "$my" . '01';
  $to = "$my" . '10';
  $dr = date('Y-m-d', strtotime($fr));
  $sp = date('Y-m-d', strtotime($to));

  // ca
  $date = date_create(date('Y-m-d'));
  date_add($date, date_interval_create_from_date_string("1 months"));
  $tanggal = date_format($date, 'd');
  date_add($date, date_interval_create_from_date_string("- $tanggal days"));
  date_add($date, date_interval_create_from_date_string("1 days"));
  $ca_date = date_format($date, 'Y-m-d');
  // echo $ca_date;
 ?>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <div class="row">
        <div class="col-xs-12">
          <?php if ( ! is_null($this->session->flashdata())): ?>
            <?php if ( ! is_null($this->session->flashdata('error_msg'))): ?>  
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $this->session->flashdata('error_msg'); ?>
              </div>
            <?php elseif ( ! is_null($this->session->flashdata('success_msg'))): ?>
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
              </div>
            <?php elseif ( ! is_null($this->session->flashdata('query_msg'))): ?>
              <div class="bs-callout-danger callout-border-left">
                <strong>Database Error!</strong>
                <p><?php echo $this->session->flashdata('query_msg')['message']; ?> <strong><?php echo $this->session->flashdata('query_msg')['code']; ?></strong></p>
              </div><br />
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- /alert -->

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Operasional</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="report-table">
                    <thead>
                      <tr>
                        <th colspan="2">Date</th>
                        <th>Detailer</th>
                        <th>Total<br />(Rp)</th>
                        <th>Potongan CA (if any)<br />(Rp)</th>
                        <th>City<br />(Rp)</th>
                        <th>Allowance<br />(Rp)</th>
                        <th>Parking &amp; Toll<br />(Rp)</th>
                        <th>Gas<br />(Rp)</th>
                        <th>Comm<br />(Rp)</th>
                        <th>Entertainment<br />(Rp)</th>
                        <th>Other<br />(Rp)</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($operasional['data']->result() as $value): ?>
                        <tr>
                          <?php $dari = date('d-M-Y', strtotime($value->dari)); ?>
                          <?php $sampai = date('d-M-Y', strtotime($value->sampai)); ?>
                          <td><?php echo $dari; ?></td>
                          <td><?php echo $sampai; ?></td>
                          <td><?php echo strtoupper($value->nama_detailer); ?></td>
                          <td><?php echo number_format($value->total, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->potongan_ca, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->city, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->allowance, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->tol_parkir, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->bensin, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->comm, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->entertainment, 0, ',', '.'); ?></td>
                          <td><?php echo number_format($value->other, 0, ',', '.'); ?></td>
                          <td>
                            <div class="btn-group-vertical">
                              <a href="<?php echo site_url(); ?>/master-operasional-print/<?php echo $value->id_detailer; ?>" target="_blank" class="btn btn-info">Print</a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /table -->

      <!-- form -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add Expense</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Expense submission form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-operasional/expense" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2" required>
                            <option value="" selected disabled>Choose Detailer</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                                <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Dari</label>
                            <input type="date" name="dari" class="form-control border-primary" value="<?php echo $dr; ?>" min="<?php echo $dr; ?>" max="<?php echo $sp; ?>" placeholder="dd-mm-yyyy" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Sampai</label>
                            <input type="date" name="sampai" class="form-control border-primary" value="<?php echo $sp; ?>" min="<?php echo $dr; ?>" max="<?php echo $sp; ?>"  required>
                          </div>
                        </div>
                        <!-- /tanggal -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">City</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="city" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /city -->
                        <div class="form-group">
                          <label class="label-control">Allowance</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="allowance" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /allowance -->
                        <div class="form-group">
                          <label class="label-control">Tol &amp; Parkir</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="tol_parkir" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /tol-parkir -->
                        <div class="form-group">
                          <label class="label-control">Bensin</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="bensin" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /bensin -->
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Comm</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="comm" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /comm -->
                        <div class="form-group">
                          <label class="label-control">Entertainment</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="entertainment" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /entertainment -->
                        <div class="form-group">
                          <label class="label-control">Other</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="other" class="form-control border-primary rincian" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /other -->
                        <div class="form-group">
                          <label class="label-control">Total</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="total" id="total" class="form-control border-primary" min="0" readonly required>
                            </div>
                          </fieldset>
                        </div>
                        <!-- /total -->
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /form -->

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#report-table th, #report-table td').css({
      'text-align': 'center',
      'vertical-align': 'top',
    });
    $('#report-table td').addClass('text-truncate');
    $('#report-table td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.rincian').blur(function() {
      var sum = 0;
      $('.rincian').each(function() {
        sum += Number($(this).val());
      });
      console.log(sum);
      $('#total').val(sum);
    });
  });
</script>

