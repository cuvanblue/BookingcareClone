<select id="selectdate{{ $doctor->id }}"
    onchange="changeDateHandle('selectdate{{ $doctor->id }}','schedules{{ $doctor->id }}' )">
    <option selected id="optiondate{{ $doctor->id }}" value="schedules{{ $doctor->id }}1">
        {{ date('Y-m-d', strtotime('+1 days')) }}</option>
    <option id="optiondate{{ $doctor->id }}" value="schedules{{ $doctor->id }}2">
        {{ date('Y-m-d', strtotime('+2 days')) }}</option>
    <option id="optiondate{{ $doctor->id }}" value="schedules{{ $doctor->id }}3">
        {{ date('Y-m-d', strtotime('+3 days')) }}</option>
    <option id="optiondate{{ $doctor->id }}" value="schedules{{ $doctor->id }}4">
        {{ date('Y-m-d', strtotime('+4 days')) }}</option>
</select>
<h4><svg style="margin-right: 5px;" viewBox="0 0 24 24" preserveAspectRatio="none" width="16" fill="#333"
        height="16">
        <path
            d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z">
        </path>
    </svg>LỊCH KHÁM</h4>
<div class="schedules">
    @for ($i = 1; $i <= 4; $i++)
        <div style="display:{{ $i == 1 ? 'block' : 'none' }};" id="schedules{{ $doctor->id }}{{ $i }}"
            class="schedules{{ $doctor->id }} schedule-container">
            @for ($j = 1; $j < count($schedules[$doctor->id][$i]); $j++)
                @if ($schedules[$doctor->id][$i][$j] == false)
                    <button style="opacity: 0.5;" disabled class="schedule">{{ $timeindexes[$j] }}</button>
                @else
                    <a
                        href="/booking/{{ $doctor->id }}/{{ date('Y-m-d', strtotime('+' . $i . ' days')) }}/{{ $j }}"><button
                            class="schedule" style="cursor: pointer;">{{ $timeindexes[$j] }}</button></a>
                @endif
            @endfor
        </div>
    @endfor
</div>
