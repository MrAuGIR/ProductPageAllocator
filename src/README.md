

## fichier de configuration

```yaml
# config/packages/element_grid_allocation.yaml
element_grid_allocation:
    grids:
        grid_medium:
            cols: 8
            rows: 10
        grid_large:
            cols: 12
            rows: 24
    dispatchers:
        custom_dispatcher:
            grid: "grid_medium"
    elements:
        element_14_pages:
            rows: 2
            cols: 8
        element_16_pages:
            rows: 1
            cols: 8
        element_12_pages:
            rows: 4
            cols: 8

```