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
              <h4 class="card-title" id="horz-layout-basic">COGM (Monthly)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="report-table">
                    <thead>
                      <tr>
                        <th>Month</th>
                        <?php foreach ($jenis['data']->result() as $value): ?>
                        <th><?php echo ucwords(strtolower($value->nama)); ?><br />(Rp)</th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($laporan['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo $value->tanggal; ?></td>
                        <td><?php echo number_format($value->bahan_baku, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->bahan_tambahan, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->pengemas, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->pekerja, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->jasa_lab, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->jasa_research, 0, ',', '.'); ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot class="border-top-green">
                      <?php foreach ($laporan_tahun['data']->result() as $value): ?>
                      <tr>
                        <th>Total</th>
                        <th><?php echo number_format($value->bahan_baku, 0, ',', '.'); ?></th>
                        <th><?php echo number_format($value->bahan_tambahan, 0, ',', '.'); ?></th>
                        <th><?php echo number_format($value->pengemas, 0, ',', '.'); ?></th>
                        <th><?php echo number_format($value->pekerja, 0, ',', '.'); ?></th>
                        <th><?php echo number_format($value->jasa_lab, 0, ',', '.'); ?></th>
                        <th><?php echo number_format($value->jasa_research, 0, ',', '.'); ?></th>
                      </tr>
                      <?php endforeach; ?>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /table -->

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">COGM</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>COGM Type</th>
                        <th>Year</th>
                        <th>Date</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($cogm['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td><?php echo ucwords($value->jenis_cogm); ?></td>
                        <td><?php echo $value->tahun; ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo number_format($value->biaya, 0, ',', '.'); ?></td>
                      </tr>
                      <?php endforeach ?>
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
              <h4 class="card-title" id="horz-layout-basic">Add COGM</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>COGM submission form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-cogm" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row div-repeat">
                      <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Date</label>
                          <input type="date" name="tanggal[]" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <!-- /tanggal -->
                      <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">COGM Type</label>
                          <select name="id_cogm[]" class="form-control select2">
                            <option value="" selected disabled>Choose type</option>
                            <?php if ($jenis['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($jenis['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>                          
                        </div>
                      </div>
                      <!-- /jenis-cogm -->
                      <div class="col-md-3 col-xs-10">
                        <div class="form-group">
                          <label class="label-control">Cost</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="biaya[]" class="form-control border-primary" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                      </div>
                      <!-- /biaya -->
                      <div class="col-md-1 col-xs-2 del-repeater">
                        <div class="form-group">
                          <label class="label-control">button</label>
                          <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                    </div>
                    <div id="repeater-out"></div>
                    <div class="row">
                      <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Add COGM</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-warning">Cancel</button>
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
    $('#simple-table th, #simple-table td').css({
      'text-align': 'center',
    });
    $('#simple-table td').addClass('text-truncate');
    $('#simple-table td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table').DataTable({
        "paging": false,
        "order": [[ 0, "desc" ]],
      });
    $('#simple-table_filter').css({
      'text-align': 'center',
    });
    $('#simple-table_wrapper').children(':first').children(':first').remove();
    $('#simple-table_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });

    $('#simple-table_wrapper').children(':last').remove();
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.del-repeater label').css({
      'color': 'transparent',
    });
    $('.del-repeater:first').hide();

    $('#add-repeater').click(function(){
      $('.div-repeat:first select').select2('destroy');
      $('.div-repeat:first').clone().appendTo('#repeater-out');
      $('.div-repeat .select2').select2();
      $('#repeater-out .del-repeater').show();
    });
  });
</script>

