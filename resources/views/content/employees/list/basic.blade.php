<li class="nav-item list-group-item">
    <a class="nav-link p-0 {{(request()->segment(3) == '')? 'active' : 'text-dark'}}" href="{{route('employee.show', request()->segment(2))}}">
      <i data-feather='user'></i> &nbsp;
      {{lang('Employees.Basic Information')}}
    </a>
</li>
<li class="nav-item list-group-item">
    <a class="nav-link {{(request()->segment(3) == 'immigration')? 'active' : 'text-dark'}} p-0" href="{{url('employee/'.request()->segment(2).'/immigration')}}">
      <i data-feather='globe'></i> &nbsp;
      {{lang('Employees.Assigned Immigration')}}
    </a>
</li>
<li class="nav-item list-group-item">
    <a class="nav-link {{(request()->segment(3) == 'emergency-contacts')? 'active' : 'text-dark'}} p-0" href="{{url('employee/'.request()->segment(2).'/emergency-contacts')}}">
      <i data-feather='phone-call'></i> &nbsp;
      {{lang('Employees.Emergency Contacts')}}
    </a>
</li>
<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'social-profile')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/social-profile')}}">
    <i data-feather='users'></i> &nbsp;
    {{lang('Employees.Social Profile')}}
  </a>
</li>
<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'education-profile')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/education-profile')}}">
    <i data-feather='users'></i> &nbsp;
    {{lang('Employees.Education profile')}}
  </a>
</li>

<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'all-documents')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/all-documents')}}">
    <i data-feather='file-text'></i> &nbsp;
    {{lang('Employees.All Documents')}}
  </a>
</li>

<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'work-experience')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/work-experience')}}">
    <i data-feather='users'></i> &nbsp;
    {{lang('Employees.Work Experience')}}
  </a>
</li>

<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'family-structure')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/family-structure')}}">
    <i data-feather='users'></i> &nbsp;
    {{lang('Employees.Family Structure')}}
  </a>
</li>

<li class="nav-item list-group-item">
  <a class="nav-link {{(request()->segment(3) == 'bank-accounts')? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/bank-accounts')}}">
    <i data-feather='circle'></i> &nbsp;
    {{lang('Employees.Bank Account')}}
  </a>
</li>