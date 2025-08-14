<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::check() && Auth::user()->usertype == 'admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('User Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 style="color: #333; text-align: center; margin-bottom: 30px;">locations Management</h1>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            <thead>
                                <tr style="background-color: #4CAF50; color: white;">
                                    <th style="padding: 12px 15px; text-align: left;">ID</th>
                                    <th style="padding: 12px 15px; text-align: left;">Title</th>
                                    <th style="padding: 12px 15px; text-align: left;">Description</th>
                                    <th style="padding: 12px 15px; text-align: left;">Image</th>
                                    <th style="padding: 12px 15px; text-align: left;">Actions</th>
                                    <th style="padding: 12px 15px; text-align: left;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($local as $locations)
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <td style="padding: 12px 15px;">{{ $locations->id }}</td>
                                        <td style="padding: 12px 15px;">{{ $locations->title }}</td>
                                        <td style="padding: 12px 15px;">{{ Str::limit($locations->description, 100) }}</td>
                                        <td style="padding: 12px 15px;">
                                            <img style="width: 100px; height: 100px;" src="{{ asset('img/'.$locations->first_image) }}" alt="{{ $locations->titile }}">
                                        </td>
                                        <td style="padding: 12px 15px;">
                                            <a href="" style="background-color: #2196F3; color: white; padding: 6px 12px; border-radius: 4px;">Update</a>
                                        </td>
                                        <td style="padding: 12px 15px;">
                                            <a href="" style="background-color: #f44336; color: white; padding: 6px 12px; border-radius: 4px;">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
