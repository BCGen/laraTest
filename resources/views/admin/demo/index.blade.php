@extends('layouts.admin.app')

@section('content')
    <demo-index></demo-index>

    <a-card title="報名列表" class="container">
        <base-table
            :row-selection="true"
            :columns="[
                { key: 'index', title: '#'},
                { key: 'name', title: '姓名' },
                { key: 'phone', title: '電話' },
                { key: 'email', title: '信箱' },
                { key: 'courses', title: '課程', scopedSlots: { customRender: 'courses' } },
                { key: 'freebie', title: '贈品'},
                { key: 'date', title: '報名日期'},
                { key: 'action', title: '管理', scopedSlots: { customRender: 'action' }, align: 'center', sorter: false }
            ]"
        >

            <template slot="courses" slot-scope="{text}">
                <span v-for="(item, index) in text" :key="index">
                    @{{ item }}
                    <br>
                </span>
            </template>

        </base-table>
    </a-card>
@endsection

