<div id="search_fpl_stats">
    <div class="col-md-12">
        <p class="stats_fpl_head_date">FPL STATS for {{isset($dof) ? $dof : date('Y-M-d')}}</p>
    </div>
    <div class="col-md-12 p-lr-0">
        <table class="stats_table" border="1">
            <tr>
                <td><p class="stats_table_td_text">TOTAL PLANS</p><span>: {{isset($total_plans) ? $total_plans : ''}}</span></td>
                <td><p class="stats_table_td_text">ADC PLANS</p><span>: {{isset($fpl_plans) ? $fpl_plans : ''}}</span></td>              
            </tr>
            <tr>
                <td><p class="stats_table_td_text">APP PLANS</p><span>: {{isset($get_fpl_count_by_app) ? $get_fpl_count_by_app : ''}}</span></td>
                <td><p class="stats_table_td_text">HELICOPTER PLANS</p><span>: {{isset($helicopter_plans) ? $helicopter_plans : ''}}</span></td>             
            </tr>
            <tr>
                <td><p class="stats_table_td_text">CANCELLED PLANS</p><span>: {{isset($get_cancel_fpl_count) ? $get_cancel_fpl_count : ''}}</span></td>
                <td><p class="stats_table_td_text">FIXED WING PLANS</p><span>: {{isset($fixed_wing_plans) ? $fixed_wing_plans : ''}}</span></td>               
            </tr>
            <tr>
                <td><p class="stats_table_td_text">ACTIVE PLANS</p><span>: {{isset($get_active_fpl_count) ? $get_active_fpl_count : ''}}</span></td>
                <td><p class="stats_table_td_text">Wx NOTAMS PLANS</p><span>: {{isset($weather_plans) ? $weather_plans : ''}}</span></td>             
            </tr>
            <tr>
                <td><p class="stats_table_td_text">DEP TIME CHANGED PLANS</p><span>: {{isset($revised_count) ? $revised_count : ''}}</span></td>
                <td><p class="stats_table_td_text">NAV LOG PLANS</p><span>:  {{isset($navlog_plans) ? $navlog_plans : ''}}</span></td>               
            </tr>
            <tr>
                <td><p class="stats_table_td_text">FPL REVISED PLANS</p><span>: {{isset($changed_count) ? $changed_count : ''}}</span></td>
                <td><p class="stats_table_td_text">LOAD TRIM PLANS</p><span>: {{isset($lnt_plans) ? $lnt_plans : ''}}</span></td>          
            </tr>
            <tr>
                <td><p class="stats_table_td_text">LATE ADC PLANS</p><span>: {{isset($adc_time_diff) ? $adc_time_diff : ''}}</span></td>
                <td><p class="stats_table_td_text">RWY ANALYSIS PLANS</p><span>: {{isset($runway_plans) ? $runway_plans : ''}}</span></td>            
            </tr>
        </table>
    </div>
</div>