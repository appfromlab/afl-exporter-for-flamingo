# AFL Exporter for Flamingo

A WordPress plugin that extends the [Flamingo](https://wordpress.org/plugins/flamingo/) plugin's CSV export functionality by providing developer-friendly hooks to customize the export data.

## Description

AFL Exporter for Flamingo enhances the Flamingo plugin's CSV export capabilities by introducing two powerful filters that allow developers to modify the CSV header and individual row data before export. This makes it easy to customize your Flamingo contact form submission exports without modifying the core plugin.

## Features

- Filter hook to customize CSV headers
- Filter hook to modify individual row data before export
- Compatible with WordPress 6.0+
- Seamless integration with Flamingo plugin

## Usage Examples

### Modifying CSV Headers

```php
/**
 * Customize the CSV header fields
 * 
 * @param array $header    Original header array
 * @param array $items     Array of Flamingo_Inbound_Message objects
 * @return array Modified header array
 */
add_filter( 'afl_eff_flamingo_inbound_csv_header', function( $header, $items ) {
    // Add a new column
    $header['custom_field'] = 'Custom Field';
    
    // Remove an existing column
    unset($header['date']);
    
    // Rename a column
    $header['id'] = 'Message ID';
    
    return $header;
}, 10, 2 );
```

### Modifying Row Data

```php
/**
 * Customize the CSV row data
 * 
 * @param array $row           Current row data
 * @param object $item         Flamingo_Inbound_Message object
 * @param array $csv_header    CSV header array
 * @return array Modified row data
 */
add_filter( 'afl_eff_flamingo_inbound_csv_item', function( $row, $item, $csv_header ) {
    // Add custom field data
    $row['custom_field'] = get_post_meta($item->id(), '_custom_field', true);
    
    // Format date differently
    $row['date'] = get_post_time('Y-m-d H:i:s', false, $item->id());
    
    // Add concatenated data
    if (isset($row['first_name']) && isset($row['last_name'])) {
        $row['full_name'] = $row['first_name'] . ' ' . $row['last_name'];
    }
    
    return $row;
}, 10, 3 );
```

## Real-World Examples

1. **Adding a Custom Status Column:**
```php
add_filter( 'afl_eff_flamingo_inbound_csv_header', function( $header, $items ) {
    $header['status'] = 'Processing Status';
    return $header;
}, 10, 2);

add_filter( 'afl_eff_flamingo_inbound_csv_item', function( $row, $item, $csv_header ) {
    $status = get_post_meta($item->id(), '_processing_status', true);
    $row['status'] = $status ? $status : 'New';
    return $row;
}, 10, 3);
```

2. **Formatting Phone Numbers:**
```php
add_filter( 'afl_eff_flamingo_inbound_csv_item', function($row, $item, $csv_header ) {
    if (isset($row['phone'])) {
        // Format: (XXX) XXX-XXXX
        $row['phone'] = preg_replace('/[^0-9]/', '', $row['phone']);
        $row['phone'] = preg_replace('/^1?([0-9]{3})([0-9]{3})([0-9]{4})$/', '($1) $2-$3', $row['phone']);
    }
    return $row;
}, 10, 3 );
```

## Installation

1. Download the latest plugin zip file from the Releases page.
2. Install the plugin via the WordPress admin dashboard.
3. The WordPress hooks will be automatically available when exporting Flamingo messages.

## Requirements

- WordPress 6.0 or higher
- [Flamingo](https://wordpress.org/plugins/flamingo/) plugin

## License

GPLv3 or later
