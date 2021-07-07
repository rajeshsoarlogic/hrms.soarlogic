<!-- -------------- Sidebar - Author -------------- -->
<div class="sidebar-widget author-widget">
    <div class="media">
        <a href="{{route('profile')}}" class="media-left">
            @if(isset(Auth::user()->employee->photo))
                <img src="{{asset('public/photos/'.Auth::user()->employee->photo)}}" width="40px" height="30px" class="img-responsive">
            @else
                <img src="/public/assets/img/avatars/profile_pic.png" class="img-responsive">
            @endif
        </a>

        <div class="media-body">
            <div class="media-author"><a href="{{route('profile')}}">{{Auth::user()->name}}</a></div>
        </div>
    </div>
</div>

<!-- -------------- Sidebar Menu  -------------- -->
<ul class="nav sidebar-menu scrollable">
    <li class="active">
        <a  href="{{route('dashboard')}}">
            <span class="fa fa-dashboard"></span>
            <span class="sidebar-title">Dashboard</span>
        </a>
    </li>

    @if(\Auth::user()->isEmployee())
    <li>
        <a href="{{route('profile')}}">
            <span class="fa fa-user"></span>
            <span class="sidebar-title"> My Profile </span>
        </a>
    </li>
    @endif

    @if(\Auth::user()->isAdmin || \Auth::user()->isHR() || \Auth::user()->isManager())
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">Employees</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-employee')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Employee </a>
                </li>
                <li>
                    <a href="{{route('employee-manager')}}">
                        <span class="glyphicon glyphicon-tags"></span> Employee Listing </a>
                </li>
                <li>
                    <a href="{{route('upload-emp')}}">
                        <span class="glyphicon glyphicon-tags"></span> Upload </a>
                </li>
                <li>
                    <a href="{{route('employee-performance.create')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Employee Performance</a>
                </li>
                <li>
                    <a href="{{route('employee-performance.index')}}">
                        <span class="glyphicon glyphicon-tags"></span> Employee Performance Listing </a>
                </li>
                <li>
                    <a href="{{route('employee-category.create')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Category</a>
                </li>
                <li>
                    <a href="{{route('employee-category.index')}}">
                        <span class="glyphicon glyphicon-tags"></span> Category Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-legal"></span>
                <span class="sidebar-title">Stamp</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('stamp.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Stamp </a>
                </li>
                <li>
                    <a href="{{route('stamp.index')}}"><span class="glyphicon glyphicon-tags"></span> Stamp Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-newspaper-o"></span>
                <span class="sidebar-title">Offer Letter</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('offer-letter.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Offer Letter </a>
                </li>
                <li>
                    <a href="{{route('offer-letter.index')}}"><span class="glyphicon glyphicon-tags"></span> Offer Letter Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-newspaper-o"></span>
                <span class="sidebar-title">Experience Letter</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('experience-letter.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Experience Letter </a>
                </li>
                <li>
                    <a href="{{route('experience-letter.index')}}"><span class="glyphicon glyphicon-tags"></span> Experience Letter Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-newspaper-o"></span>
                <span class="sidebar-title">Appraisal Letter</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('appraisal.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Appraisal Letter </a>
                </li>
                <li>
                    <a href="{{route('appraisal.index')}}"><span class="glyphicon glyphicon-tags"></span> Appraisal Letter Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-newspaper-o"></span>
                <span class="sidebar-title">Department</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('department.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Department </a>
                </li>
                <li>
                    <a href="{{route('department.index')}}"><span class="glyphicon glyphicon-tags"></span> Department Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-newspaper-o"></span>
                <span class="sidebar-title">Designation</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('designation.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Designation </a>
                </li>
                <li>
                    <a href="{{route('designation.index')}}"><span class="glyphicon glyphicon-tags"></span> Designation Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-paint-brush"></span>
                <span class="sidebar-title">Digital Signature</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('digital-sig.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Digital Signature </a>
                </li>
                <li>
                    <a href="{{route('digital-sig.index')}}"><span class="glyphicon glyphicon-tags"></span> Digital Signature Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-paint-brush"></span>
                <span class="sidebar-title">Template</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('template.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Template </a>
                </li>
                <li>
                    <a href="{{route('template.index')}}"><span class="glyphicon glyphicon-tags"></span> Template Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-paint-brush"></span>
                <span class="sidebar-title">Salary Slip</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('salaryslip.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Salary Slip </a>
                </li>
                <li>
                    <a href="{{route('salaryslip.index')}}"><span class="glyphicon glyphicon-tags"></span> Salary Slip Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-building-o"></span>
                <span class="sidebar-title">Company Details</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('company-detail.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Company Details </a>
                </li>
                <li>
                    <a href="{{route('company-detail.index')}}"><span class="glyphicon glyphicon-tags"></span> Company Details Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-cogs"></span>
                <span class="sidebar-title">Skill Set</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('skill-set.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Skill </a>
                </li>
                <li>
                    <a href="{{route('skill-set.index')}}"><span class="glyphicon glyphicon-tags"></span> Skill Set Listing </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-file-excel-o"></span>
                <span class="sidebar-title">Invoice</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('invoice.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Invoice </a>
                </li>
                <li>
                    <a href="{{route('invoice.index')}}"><span class="glyphicon glyphicon-tags"></span> Invoice Listing </a>
                </li>
                <li>
                    <a href="{{route('invoice.send')}}"><span class="glyphicon glyphicon-tags"></span> Send Invoice </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">Clients</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-client')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Client </a>
                </li>

                <li>
                    <a href="{{route('list-client')}}">
                        <span class="glyphicon glyphicon-tags"></span> List Client </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-money"></span>
                <span class="sidebar-title">Payment Details</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('payment-details.create')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Payment Details </a>
                </li>

                <li>
                    <a href="{{route('payment-details.index')}}">
                        <span class="glyphicon glyphicon-tags"></span> List Payment Details </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">Projects</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-project')}}">
                        <span class="glyphicon glyphicon-tags"></span> Add Project </a>
                </li>

                <li>
                    <a href="{{route('list-project')}}">
                        <span class="glyphicon glyphicon-tags"></span> List Project</a>
                </li>

                <li>
                    <a href="{{route('assign-project')}}">
                        <span class="glyphicon glyphicon-tags"></span> Assign Project</a>
                </li>

                <li>
                    <a href="{{route('project-assignment-listing')}}">
                        <span class="glyphicon glyphicon-tags"></span> Project Assignment Listing</a>
                </li>
            </ul>
        </li>

        <li>

            <a href="/bank-account-details">
                <span class="fa fa-bank"></span>
                <span class="sidebar-title">Bank Account</span>

            </a>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-group"></span>
                <span class="sidebar-title">Teams</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-team')}}">
                        <span class="glyphicon glyphicon-book"></span> Add Team </a>
                </li>
                <li>
                    <a href="{{route('team-listing')}}">
                        <span class="glyphicon glyphicon-modal-window"></span> Team Listings </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-graduation-cap"></span>
                <span class="sidebar-title">Roles</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-role')}}">
                        <span class="glyphicon glyphicon-book"></span> Add Role </a>
                </li>
                <li>
                    <a href="{{route('role-list')}}">
                        <span class="glyphicon glyphicon-modal-window"></span> Role Listings </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa fa-laptop"></span>
                <span class="sidebar-title">Assets</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-asset')}}">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Add Asset </a>
                </li>
                <li>
                    <a href="{{route('asset-listing')}}">
                        <span class="glyphicon glyphicon-calendar"></span> Asset Listings </a>
                </li>
                <li>
                    <a href="{{route('assign-asset')}}">
                        <span class="fa fa-desktop"></span> Assign Asset </a>
                </li>
                <li>
                    <a href="{{route('assignment-listing')}}">
                        <span class="fa fa-clipboard"></span> Assignment Listings </a>
                </li>
            </ul>
        </li>
    @endif

    @if(Auth::user()->isHR())
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-gavel"></span>
                <span class="sidebar-title"> Company Policy </span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('policy.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Policy </a>
                </li>
                <li>
                    <a href="{{route('policy.index')}}"><span class="glyphicon glyphicon-tags"></span> Policy Listing </a>
                </li>
                <!-- <li>
                    <a href="{{route('policy.policies')}}"><span class="glyphicon glyphicon-tags"></span> Policies </a>
                </li> -->
            </ul>
        </li>
        
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-arrow-circle-o-up"></span>
                <span class="sidebar-title">Promotions</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="/promotion">
                        <span class="glyphicon glyphicon-book"></span> Promote </a>
                </li>
                <li>
                    <a href="/show-promotion">
                        <span class="glyphicon glyphicon-modal-window"></span> Promotion Listings </a>
                </li>
            </ul>
        </li>

        <!-- <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-money"></span>
                <span class="sidebar-title">Expenses</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-expense')}}">
                        <span class="glyphicon glyphicon-book"></span> Add Expense </a>
                </li>
                <li>
                    <a href="{{route('expense-list')}}">
                        <span class="glyphicon glyphicon-modal-window"></span> Expense Listings </a>
                </li>
            </ul>
        </li> -->

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-money"></span>
                <span class="sidebar-title">Company Expenses</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('company-expense.create')}}">
                        <span class="glyphicon glyphicon-book"></span> Add Company Expense </a>
                </li>
                <li>
                    <a href="{{route('company-expense.index')}}">
                        <span class="glyphicon glyphicon-modal-window"></span> Company Expense Listings </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa fa-trophy"></span>
                <span class="sidebar-title">Awards</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="/add-award">
                        <span class="fa fa-adn"></span> Add Award </a>
                </li>
                <li>
                    <a href="/award-listing">
                        <span class="glyphicon glyphicon-calendar"></span> Award Listings </a>
                </li>
                <li>
                    <a href="/assign-award">
                        <span class="fa fa-desktop"></span> Awardees </a>
                </li>
                <li>
                    <a href="/awardees-listing">
                        <span class="fa fa-clipboard"></span> Awardees Listings </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="#">
                <span class="fa fa-clock-o"></span>
                <span class="sidebar-title"> Attendance </span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('attendance-upload')}}">
                        <span class="glyphicon glyphicon-book"></span> Upload Sheets</a>
                </li>

            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="#">
                <span class="fa fa-tree"></span>
                <span class="sidebar-title">Holiday</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="/add-holidays">
                        <span class="glyphicon glyphicon-book"></span> Add Holiday </a>
                </li>
                <li>
                    <a href="/holiday-listing">
                        <span class="glyphicon glyphicon-modal-window"></span> Holiday Listings </a>
                </li>
            </ul>
        </li>
    @endif

    <li>
        <a class="accordion-toggle" href="/dashboard">
            <span class="fa fa-envelope"></span>
            <span class="sidebar-title">Leaves</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            <li>
                <a href="{{route('apply-leave')}}">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Apply Leave </a>
            </li>
            <li>
                <a href="{{route('my-leave-list')}}">
                    <span class="glyphicon glyphicon-calendar"></span> My Leave List </a>
            </li>

            @if(\Auth::user()->isHR())
                <li>
                    <a href="{{route('add-leave-type')}}">
                        <span class="fa fa-desktop"></span> Add Leave Type </a>
                </li>
                <li>
                    <a href="{{route('leave-type-listing')}}">
                        <span class="fa fa-clipboard"></span> Leave Type Listings </a>
                </li>
            @endif
            @if(Auth::user()->isHR() || Auth::user()->isCoordinator())
                <li>
                    <a href="{{route('total-leave-list')}}">
                        <span class="fa fa-clipboard"></span> Total Leave Listings </a>
                </li>
            @endif
        </ul>
    </li>

    <li>
        <a class="accordion-toggle" href="/dashboard">
            <span class="fa fa-briefcase"></span>
            <span class="sidebar-title">Recruiter</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            <li>
                <a href="{{route('recruiter.create')}}"><span class="glyphicon glyphicon-tags"></span> Add Candidate </a>
            </li>
            <li>
                <a href="{{route('recruiter.index')}}"><span class="glyphicon glyphicon-tags"></span> Candidate Listing </a>
            </li>
        </ul>
    </li>

    <li>
        <a class="accordion-toggle" href="#">
            <span class="fa fa fa-gavel"></span>
            <span class="sidebar-title">Trainings</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            @if(\Auth::user()->notAnalyst())
                <li>
                    <a href="/add-training-program">
                        <span class="fa fa-adn"></span> Add Training Program </a>
                </li>
            @endif
            <li>
                <a href="/show-training-program">
                    <span class="glyphicon glyphicon-calendar"></span> Program Listings </a>
            </li>
            @if(\Auth::user()->notAnalyst())
                <li>
                    <a href="/add-training-invite">
                        <span class="fa fa-desktop"></span> Training Invite </a>
                </li>
            @endif
            <li>
                <a href="/show-training-invite">
                    <span class="fa fa-clipboard"></span> Invitation Listings </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="/create-meeting">
            <span class="fa fa-calendar-o"></span>
            <span class="sidebar-title"> Meeting  &nbsp Invitation </span>
        </a>
    </li>

    @if(Auth::user()->isCoordinator() ||  Auth::user()->isHR())
        <li>
            <a href="/create-event">
                <span class="fa fa-calendar-o"></span>
                <span class="sidebar-title"> Event  &nbsp Invitation </span>
            </a>
        </li>
    @endif

    @if( !\Auth::user()->isAdmin && \Auth::user()->isEmployee() && (\Auth::user()->offerletter == 1) )
    <li>
        <a href="{{route('my.offer.letter', \Auth::user()->id)}}">
            <span class="fa fa-book"></span>
            <span class="sidebar-title">My Offer Letter</span>

        </a>
    </li>
    @endif

    <li>
        <a href="/download-forms">
            <span class="fa fa-book"></span>
            <span class="sidebar-title">Download Forms</span>

        </a>
    </li>

    <li>
        <a href="{{route('policy.policies')}}">
            <span class="fa fa-gavel"></span>
            <span class="sidebar-title"> Company Policy </span>
        </a>
    </li>

    <p> &nbsp; </p>
</ul>
<!-- -------------- /Sidebar Menu  -------------- -->