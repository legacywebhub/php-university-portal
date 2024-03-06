<style>
    .hidden {
        display: none;
    }
</style>
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Hi, <?=$context['student']['firstname']; ?>!</h4>
            <p class="mb-0">Welcome back to your portal</p>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="profile">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo"></div>
                </div>
                <div class="profile-info">
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="profile-photo">
                                <?php if (empty($context['student']['passport'])): ?>
                                <img class="img-fluid rounded-circle" width="100" src="<?=STATIC_ROOT; ?>/default_user.png">
                                <?php else: ?>
                                <img class="img-fluid rounded-circle" width="100" src="<?=MEDIA_ROOT; ?>/users/<?=$context['student']['passport']; ?>">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-sm-9 col-12">
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 border-right-1">
                                    <div class="profile-name">
                                        <h4 class="text-primary mb-0"><?=$context['student']['firstname']." ".$context['student']['lastname']; ?></h4>
                                        <p><?=$context['student']['matric_number']; ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 border-right-1">
                                    <div class="profile-email">
                                        <h4 class="text-muted mb-0"><?=$context['student']['email']; ?></h4>
                                        <p>Gender: 
                                            <b>
                                            <?php if ($context['student']['gender']=="M"): ?>Male<?php else: ?>Female<?php endif ?>
                                            </b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="profile-statistics">
                    <div class="text-center mt-4 border-bottom-1 pb-3">
                        <div class="row">
                            <div class="col">
                                <h3 class="m-b-0">150</h3><span>Courses</span>
                            </div>
                            <div class="col">
                                <h3 class="m-b-0">140</h3><span>Lessons</span>
                            </div>
                            <div class="col">
                                <h3 class="m-b-0">45</h3><span>Tests</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="javascript:void()" class="btn btn-primary px-5 mr-3 mb-4">Follow</a> 
                            <a href="javascript:void()" class="btn btn-dark px-3 mb-4">Send Message</a>
                        </div>
                    </div>
                </div>
                <div class="pt-4 border-bottom-1">
                    <h4 class="text-primary">About Me</h4>
                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the
                        bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                    <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed
                        in a nice, gilded frame.</p>
                </div>
                <div class="profile-lang pt-5 border-bottom-1 pb-5">
                    <h4 class="text-primary mb-4">Language</h4><a href="javascript:void()" class="text-muted pr-3 f-s-16"><i class="flag-icon flag-icon-us"></i> English</a>
                </div>
                <div class="profile-personal-info">
                    <h4 class="text-primary mb-4">Personal Information</h4>
                    <div class="row mb-4">
                        <div class="col-3">
                            <h5 class="f-w-500">Department <span class="pull-right">:</span>
                            </h5>
                        </div>
                        <div class="col-9"><span><?=fetch_department($context['student']['department_id']); ?></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3">
                            <h5 class="f-w-500">Faculty <span class="pull-right">:</span>
                            </h5>
                        </div>
                        <div class="col-9"><span><?=fetch_faculty($context['student']['faculty_id']); ?></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3">
                            <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                        </div>
                        <div class="col-9"><span><?=$context['student']['dob']; ?></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3">
                            <h5 class="f-w-500">Age <span class="pull-right">:</span>
                            </h5>
                        </div>
                        <div class="col-9"><span>27</span></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3">
                            <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                        </div>
                        <div class="col-9"><span><?=$context['student']['address']; ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#my-messages" data-toggle="tab" class="nav-link active show">My messages</a>
                            </li>
                            <li class="nav-item"><a href="#send-message" data-toggle="tab" class="nav-link">Send a message</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="my-messages" class="tab-pane fade active show">
                                <div class="my-post-content pt-3">
                                    <?php if(empty($context['my_messages'])): ?>
                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                        <h4>No new messages</h4>
                                    </div>
                                    <?php else: ?>
                                        <?php foreach($context['my_messages'] as $message):
                                            // Fetching sender details
                                            $sender = fetch_student($message['sender_id']);
                                        ?>
                                        <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                            <!-- <img src="<?=STATIC_ROOT; ?>/dashboard/images/profile/8.jpg" alt="" class="img-fluid"> -->
                                            <a class="post-title" href="javascript:void()">
                                                <h4><?=$message['subject']; ?></h4>
                                            </a>
                                            <p><?=$message['message']; ?></p>
                                            <h6 class="mb-4 text-capitalize"><?=$sender['fullname']; ?> - <?=$sender['matric_number']; ?></h6>
                                            <button class="btn btn-primary mr-3"><span class="mr-3"><i class="fa fa-heart"></i></span>Like</button>
                                            <button class="btn btn-secondary reply-btn"><span class="mr-3"><i class="fa fa-reply"></i></span>Reply</button>
                                            <div class="post-input reply-container hidden">
                                            <form class="reply-form">
                                                <!-- The sender now becomes the receiver and current user becomes the sender -->
                                                <input type="hidden" class="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                                                <input type="hidden" class="receiver_id" value=<?=$message['sender_id']; ?>>
                                                <input type="hidden" class="subject" value=<?="Message Reply"; ?>>
                                                <textarea class="form-control bg-transparent reply" id="textarea" cols="30" rows="5" placeholder="Please type what you want...." minlength="5" maxlength="2000"></textarea>
                                                <button class="btn btn-primary"><span class="btn-text">Reply</span></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endforeach ?>
                                        <div class="text-center mb-2"><a href="javascript:void()" class="btn btn-primary">See More</a></div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div id="send-message" class="tab-pane fade">
                                <div class="pt-3">
                                    <div class="settings-form">
                                        <form class="msg-form">
                                            <input type="hidden" class="form-control csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">To</span>
                                                    </div>
                                                    <input type="text" class="form-control reg_no" maxlength="15" placeholder="Matric/Reg No">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Subject</span>
                                                    </div>
                                                    <input type="text" class="form-control subject" maxlength="100">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="summernote message" maxlength="2000"></textarea>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-primary float-right">
                                                        <span class="btn-text">Send <i class="fas fa-paper-plane"></i></span>
                                                    </button>									
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Your course mates</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive recentOrderTable">
                    <table class="table verticle-middle table-responsive-md">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Matric No.</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($context['coursemates'])): ?>
                                No course mates yet
                            <?php else: ?>
                                <?php foreach($context['coursemates'] as $coursemate): ?>
                                <tr>
                                    <td><?=$coursemate['firstname']." ".$coursemate['lastname']; ?></td>
                                    <td><?=$coursemate['matric_number']; ?></td>
                                    <td><?=$coursemate['gender']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="la la-eye"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to toggle each reply message form -->
<script type="text/javascript">
    let replyBtns = document.querySelectorAll('.reply-btn')

    replyBtns.forEach((each)=>{
      each.addEventListener('click', function(){
        div = each.parentElement.parentElement;
        replyContainer = div.querySelector(".reply-container");
        replyContainer.classList.toggle('hidden');
      })
    })
  </script>

  <!-- Script to send send replies to backend -->
  <script>
    // Array.from() converts nodlists to regular javascript arrays
    let replyForms = Array.from(document.querySelectorAll('.reply-form')),
    url = window.location.href;

    // Looping through the reply forms
    for (let i=0; i < replyForms.length; i++) {
        replyForms[i].addEventListener('submit', function(e){
            e.preventDefault();

            // Declaring this form variables
            let formBtn = this.querySelector('.btn'),
            btnText = formBtn.querySelector('.btn-text'),
            data = {
                'receiver_id': parseInt(document.querySelector('.receiver_id').value),
                'subject': this.querySelector('.subject').value,
                'reply': this.querySelector('.reply').value,
                'csrf_token': this.querySelector('.csrf_token').value
            };

            // Loading animation
            btnText.innerHTML = `Sending...<img width='30px' src="<?=STATIC_ROOT; ?>/dashboard/images/spinner-white.svg">`;
            formBtn.disabled = true;

            fetch(url, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then((response)=>{
                return response.json()
            })
            .then((data)=>{
                console.log(data);
                if (data['status'] == 'success') {
                    btnText.innerHTML = `Sent`;
                    setTimeout(()=>{
                        this.reset();
                        swal("", data['message'], "success");
                    }, 3000);
                } else {
                    btnText.innerHTML = `Reply`;
                    formBtn.disabled = false;
                    setTimeout(()=>{
                        swal("", data['message'], "error");
                    }, 3000);
                }
            })
            .catch((err)=>{
                console.log(err);
                btnText.innerHTML = `Reply`;
                formBtn.disabled = false;
                setTimeout(()=>{
                    swal("", "Oops.. An error occured", "error");
                }, 3000);
            })

        });
    };

</script>

<!-- Script to send message to backend -->
<script>
    let msgForm = document.querySelector('.msg-form');

    msgForm.addEventListener('submit', (e)=> {
        e.preventDefault();

        data = {
            'reg_no': msgForm.querySelector('.reg_no').value,
            'subject': msgForm.querySelector('.subject').value,
            'message': msgForm.querySelector('.message').value,
            'csrf_token': msgForm.querySelector('.csrf_token').value
        };

        // Loading animation
        let formBtn = msgForm.querySelector('.btn');
        btnText = msgForm.querySelector('.btn-text');
        btnText.innerHTML = `Sending...<img width='30px' src="<?=STATIC_ROOT; ?>/dashboard/images/spinner-white.svg">`;
        formBtn.disabled = true;

        fetch(url, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then((response)=>{
            return response.json()
        })
        .then((data)=>{
            console.log(data);
            if (data['status'] == 'success') {
                btnText.innerHTML = `Sent`;
                setTimeout(()=>{
                    msgForm.reset();
                    swal("", data['message'], "success");
                }, 5000);
            } else {
                btnText.innerHTML = `Send <i class="fas fa-paper-plane">`;
                formBtn.disabled = false;
                setTimeout(()=>{
                    swal("", data['message'], "error");
                }, 5000);
            }
        })
        .catch((err)=>{
            console.log(err);
            btnText.innerHTML = `Send <i class="fas fa-paper-plane">`;
            formBtn.disabled = false;
            setTimeout(()=>{
                swal("", "Oops.. An error occured", "error");
            }, 5000);
        })

    });

</script>