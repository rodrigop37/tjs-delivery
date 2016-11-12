<div class="jckwds-reserve-wrap">

    <?php /* ?>
    <form class="jckwds-shipping-postcode-form" action="" method="get">
        <p><?php _e('Make sure your preferred slot is available by entering your shipping postcode.', 'jckwds'); ?></p>
        <input class="jckwds-shipping-postcode" type="text" name="postcode" placeholder="<?php _e('Shipping postcode', 'jckwds'); ?>" value="<?php if(isset($_GET['postcode'])) echo $_GET['postcode']; ?>">
    </form>
    <?php */ ?>

    <table class="jckwds-reserve">
        <thead>
            <tr>
                <th class="alwaysVis">
                    <a href="#" class="jckwds-prevday"><i class="jckwds-icn-left"></i></a>
                    <a href="#" class="jckwds-nextday"><i class="jckwds-icn-right"></i></a>
                </th>

                <?php if( !empty( $reservation_table_data['headers'] ) ) { ?>
                    <?php $i = 0; foreach( $reservation_table_data['headers'] as $header_data ) { ?>

                        <th <?php echo $header_data['classes']; ?>><?php echo $header_data['cell']; ?></th>

                    <?php $i++; } ?>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if( !empty( $reservation_table_data['body'] ) ) { ?>
                <?php $i = 0; foreach( $reservation_table_data['body'] as $rows ) { ?>

                    <tr>

                        <?php foreach( $rows as $row ) {?>

                            <<?php echo $row['cell_type']; ?> <?php echo $row['classes']; ?> <?php echo $row['attributes']; ?>>
                                <?php echo $row['cell']; ?>
                            </<?php echo $row['cell_type']; ?>>

                        <?php } ?>

                    </tr>

                <?php $i++; } ?>
            <?php } ?>
        </tbody>
    </table>

</div>