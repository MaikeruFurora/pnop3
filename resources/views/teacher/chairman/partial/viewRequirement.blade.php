  <!-- Modal -->
  <div class="modal fade" id="viewRequirementModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewRequirementTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pb-0 pl-1 pr-1">
            <p class="pl-4"><i class="fas fa-fingerprint"></i> To see a larger version of the image, click on it.</p>
            <input type="hidden" name="dirNow" value="{{ asset('') }}">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-graduation-cap"></i> Grade</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-certificate"></i> PSA</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-thumbs-up"></i> Good Moral</a>
                </li>
              </ul>
              <div class="tab-content tab-bordered shadow" id="myTab3Content">
                <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                    <img class="img-thumbnail" id="req_grade" src="">
                </div>
                <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                    <img class="img-thumbnail" id="req_psa" src="">
                </div>
                <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
                    <img class="img-thumbnail" id="req_goodmoral" src="">
                 </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>