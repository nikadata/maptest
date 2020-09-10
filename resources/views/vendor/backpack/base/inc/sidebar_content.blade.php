<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href='{{ backpack_url('village') }}'><i class='fa fa-home'></i> <span>Villages</span></a></li>
<li><a href='{{ backpack_url('county') }}'><i class='fa fa-map-signs'></i> <span>Counties</span></a></li>
<li><a href='{{ backpack_url('district') }}'><i class='fa fa-globe'></i> <span>Districts</span></a></li>
<li><a href='{{ backpack_url('country') }}'><i class='fa fa-globe'></i> <span>Countries</span></a></li>
<li><a href='{{ backpack_url('source') }}'><i class='fa fa-map'></i> <span>Sources</span></a></li>
<li><a href='{{ backpack_url('skillcat') }}'><i class='fa fa-folder'></i> <span>Skill categories</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>