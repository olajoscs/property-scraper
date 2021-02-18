@extends('mail.layout')


@section('css')
        .property-list {

        }

        .property-list td {
            padding: 5px;
        }

        .property-list td img {
            width: 8rem;
        }

        .site-name td {
            margin-top: 10px;
        }

        .property-item {
            border-top: 1px solid gray;
        }

        .property-item td {
        }
@endsection


@section('content')
<?php
/**
 * @var \App\Models\Property[][] $groupedProperties
 * @var \App\Models\Sites\Site[] $sites
 */
?>
    @foreach ($groupedProperties as $siteName => $properties)
    <table class="property-list">
        <tbody>
            <tr class="site-name">
                <td colspan="4">{{ $siteName }}</td>
            </tr>
            @foreach ($properties as $property)
                <tr class="property-item">
                    <td rowspan="3">
                        <a href="{{ $linkGenerator($property->link, $sites[$siteName]) }}">
                            <img src="{{ $property->image }}">
                        </a>
                    </td>
                    <td colspan="3">
                        <a href="{{ $linkGenerator($property->link, $sites[$siteName]) }}">
                            {{ $property->isNew() ? __('mail.property_is_new') : '' }} {{ $property->name }}&nbsp;
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="{{ $linkGenerator($property->link, $sites[$siteName]) }}">
                            {{ $property->place }}
                        </a>
                    </td>

                </tr>
                <tr>
                    <td>{{ number_format($property->price, 0, '.', ' ') }} Ft</td>
                    <td>{{ $property->area }} m2</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
@endsection