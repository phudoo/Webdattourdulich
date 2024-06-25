<?php
                        $sql = "SELECT * FROM datkhachsan WHERE tentaikhoan = '" . $_SESSION['tentaikhoan'] . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . " - <strong>Ngày Nhận Phòng:</strong> " . $row["ngaynhanphong"] . "</p>";
                            }
                        } else {
                            echo "<p>Không có lịch sử đặt khách sạn</p>";
                        }
                        ?>